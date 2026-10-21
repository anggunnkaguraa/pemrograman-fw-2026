
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Data Produk</h2>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">
                + Tambah Produk
            </a>
        </div>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
               
<form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Stock</label>
        <input type="text" name="stock" value="{{ old('stock', $product->stock) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="text" name="price" value="{{ old('price', $product->price) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">ID Kategori</label>
        <input type="text" name="category_id" value="{{ old('category_id', $product->category_id) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Kode Produk</label>
        <input type="text" name="code" value="{{ old('code', $product->code) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Unit</label>
        <input type="text" name="unit" value="{{ old('unit', $product->unit) }}"
            class="mt-1 block w-full rounded-md border-gray-300">
    </div>
    <!-- field lain mengikuti pola yang sama -->
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
</form>


            </x-card>
        </div>
    </div>
</x-app-layout>

