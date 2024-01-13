<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RestApiController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            $data = $response->json();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;

            $currentItems = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
            $paginatedData = new LengthAwarePaginator($currentItems, count($data), $perPage, $currentPage, ['path' =>
                'home']);

            return view('restApi.index', compact('paginatedData'));
        }
        return redirect('/dashboard');
    }
    public function edit($id)

    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/' . $id);
        $data = $response->json();
        return view('restApi.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {

        $response = Http::put('https://jsonplaceholder.typicode.com/posts/' . $id, [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        if ($response->successful()) {
            return redirect()->route('home')->with('success', 'Updated successfully!');
        } else {
            return redirect()->route('home')->with('error', 'Failed to update. Please try again.');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/' . $id);

        if ($response->successful()) {
            return redirect()->route('home')->with('success', 'Deleted successfully!');
        } else {
            return redirect()->route('home')->with('error', 'Failed to delete. Please try again.');
        }
    }
}
