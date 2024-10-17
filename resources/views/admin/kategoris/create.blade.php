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
                        <h2>Create a New Kategori</h2>
                        <form action="{{ route('admin.kategoris.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori:</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                            </div>
                            <div class="flex justify-between mt-3">
                                <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
