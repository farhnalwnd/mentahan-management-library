<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center">
                <div class="mt-3 mx-4 my-3 p-3 text-gray-900 dark:text-gray-100">
                    <p><a href="dashboard/buku" class="btn btn-primary">buku</a></p>
                </div>
                <div class="mt-3 mx-4 my-3 p-3 text-gray-900 dark:text-gray-100">
                    <p><a href="dashboard/kategoris" class="btn btn-primary">Kategori</a></p>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>