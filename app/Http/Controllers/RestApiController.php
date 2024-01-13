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
            $response = Http::get('https://jsonplaceholder.org/posts');
            $data = $response->json();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;

            $currentItems = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
            $paginatedData = new LengthAwarePaginator($currentItems, count($data), $perPage, $currentPage, ['path' =>
                'home']);

            return view('restApi.index', compact('paginatedData'));
        }
    }
}
