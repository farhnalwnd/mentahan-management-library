<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-1 lg:px-5">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h2>Kategori List</h2>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <a href="{{ route('admin.kategoris.create') }}" class="btn btn-info mb-4">Add New Kategori</a>
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-start mt-3">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>