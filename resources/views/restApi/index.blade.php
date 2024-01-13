<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('REST API Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($paginatedData as $post)
                            <tr>
                                <td>{{ $post['id'] }}</td>
                                <td>
                                    <img src="{{ $post['thumbnail'] }}" width="50px" height="50px">
                                </td>

                                <td>
                                    {{ $post['title'] }}
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <a class="btn btn-primary" href="">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $paginatedData->links() }}
    </div>
</x-app-layout>
