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
                        <div class="flex justify-between mb-5">
                            <h2>Buku List</h2>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <a href="{{ route('admin.buku.create') }}" class="btn btn-primary mb-2">Tambah Buku</a>
                        </div>
                        <form id="search-form" method="GET" action="{{ route('admin.buku.index') }}">
                            <div class="mb-3 flex">
                                <select id="category" name="category_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('category_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">Cari</button>
                            </div>
                        </form>                        

                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>ID Buku</th>
                                    <th>Nama Buku</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Upload PDF</th>
                                    <th>Upload Cover</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bukus as $buku)
                                <tr>
                                    <td>{{ $buku->id }}</td>
                                    <td>{{ $buku->nama_buku }}</td>
                                    <td>{{ $buku->kategori->nama_kategori }}</td>
                                    <td>{{ $buku->jumlah }}</td>
                                    <td>
                                        @if($buku->upload_pdf)
                                        <a href="{{ Storage::url($buku->upload_pdf) }}" target="_blank">Download PDF</a>                                       
                                        @else
                                            Tidak ada PDF
                                        @endif
                                    </td>
                                    <td>
                                        @if($buku->upload_cover)
                                            <img src="{{ Storage::url($buku->upload_cover) }}" alt="Cover" width="100">
                                        @else
                                            Tidak ada Cover
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data belum diinput.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $bukus->links() }}
                        </div>
                    </div>
                    <div class="flex justify-start mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
