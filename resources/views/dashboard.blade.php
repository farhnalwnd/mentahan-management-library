<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mb-6">
                        <div class="flex justify-between mb-5">
                            <h2>Buku List</h2>
                            <a href="{{ route('user.favorites') }}" class="btn btn-outline-warning">Buku Favorit</a>
                        </div>
                        <form id="search-form" method="GET" action="{{ route('dashboard') }}">
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
                                    <th>Tambah Favorite</th>
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
                                        <form class="add-favorite-form" data-buku-id="{{ $buku->id }}">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                            <button type="button" class="btn btn-primary add-favorite-btn">Tambah Favorite</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada buku terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                
                                @if ($bukus->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bukus->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($bukus->getUrlRange(1, $bukus->lastPage()) as $page => $url)
                                    <li class="page-item {{ $bukus->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($bukus->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bukus->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-favorite-btn').on('click', function() {
                var form = $(this).closest('form');
                var bukuId = form.find('input[name="buku_id"]').val();
                var url = "{{ route('user.add.favorite') }}";

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        buku_id: bukuId
                    },
                    success: function(response) {
                        alert('Buku telah ditambahkan ke favorit!');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan, silakan coba lagi.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
