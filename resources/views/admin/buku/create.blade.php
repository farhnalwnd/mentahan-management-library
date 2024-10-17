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
                        <h2>Create a New Buku</h2>
                        <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_buku">Nama Buku:</label>
                                <input type="text" class="form-control mt-2 mb-3" id="nama_buku" name="nama_buku" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori:</label>
                                <select class="form-control mt-2 mb-3" id="kategori_id" name="kategori_id" required>
                                    <option value="">Select a Category</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" class="form-control mt-2 mb-3" id="jumlah" name="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label for="upload_pdf">Upload PDF (Optional):</label>
                                <input type="file" class="form-control mt-2 mb-3" id="upload_pdf" name="upload_pdf" accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label for="upload_cover">Upload Cover (Optional):</label>
                                <input type="file" class="form-control mt-2 mb-3" id="upload_cover" name="upload_cover" accept="image/*">
                            </div>
                            <div class="flex justify-between mt-3">
                            <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">Kembali</a>                            
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>