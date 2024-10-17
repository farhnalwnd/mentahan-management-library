<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buku Favorit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-1 lg:px-5">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h2>Daftar Buku Favorit</h2>
                        <form id="search-form" method="GET" action="{{ route('user.favorites') }}">
                            <div class="mb-3 flex">
                                <select id="category" name="category_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">Cari</button>
                            </div> 
                        </form>
                        <table class="table table-hover table-dark mt-4">
                            <thead>
                                <tr>
                                    <th>ID Buku</th>
                                    <th>Nama Buku</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Uploaded PDF</th>
                                    <th>Uploaded Cover</th>
                                    <th>Aksi</th>
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
                                        <form class="remove-favorite-form" data-buku-id="{{ $buku->id }}">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                            <button type="button" class="btn btn-danger remove-favorite-btn">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada buku favorit.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="text-right mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.remove-favorite-btn').on('click', function() {
                var form = $(this).closest('form');
                var bukuId = form.find('input[name="buku_id"]').val();
                var url = "{{ route('user.remove.favorite') }}";

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        buku_id: bukuId
                    },
                    success: function(response) {
                        alert('Buku telah dihapus dari favorit!');
                        form.closest('tr').remove();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan, silakan coba lagi.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
