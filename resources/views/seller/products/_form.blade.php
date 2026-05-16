@php
    $isEdit = isset($product);
@endphp

<div class="grid gap-5">
    <div>
        <label for="name" class="text-sm font-bold text-[#3a281f]">Nama Produk</label>
        <input id="name" name="name" type="text" value="{{ old('name', $product->name ?? '') }}" required class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
        <x-form-error name="name" />
    </div>

    <div>
        <label for="category_id" class="text-sm font-bold text-[#3a281f]">Kategori</label>
        <select id="category_id" name="category_id" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <option value="">Tanpa kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <x-form-error name="category_id" />
    </div>

    <div>
        <label for="description" class="text-sm font-bold text-[#3a281f]">Deskripsi</label>
        <textarea id="description" name="description" rows="5" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">{{ old('description', $product->description ?? '') }}</textarea>
        <x-form-error name="description" />
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="price" class="text-sm font-bold text-[#3a281f]">Harga</label>
            <input id="price" name="price" type="number" min="0" step="1000" value="{{ old('price', $product->price ?? 0) }}" required class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <x-form-error name="price" />
        </div>
        <div>
            <label for="stock" class="text-sm font-bold text-[#3a281f]">Stok</label>
            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <x-form-error name="stock" />
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="selling_type" class="text-sm font-bold text-[#3a281f]">Tipe Penjualan</label>
            <select id="selling_type" name="selling_type" required class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                <option value="internal" @selected(old('selling_type', $product->selling_type ?? 'internal') === 'internal')>Internal KriyaLokal</option>
                <option value="external" @selected(old('selling_type', $product->selling_type ?? '') === 'external')>Eksternal Marketplace</option>
                <option value="both" @selected(old('selling_type', $product->selling_type ?? '') === 'both')>Keduanya</option>
            </select>
            <x-form-error name="selling_type" />
        </div>
        <div>
            <label for="external_url" class="text-sm font-bold text-[#3a281f]">URL Marketplace</label>
            <input id="external_url" name="external_url" type="url" value="{{ old('external_url', $product->external_url ?? '') }}" placeholder="https://..." class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <x-form-error name="external_url" />
        </div>
    </div>

    <div class="rounded-lg border border-dashed border-[#d8c4aa] bg-[#fff8ec] p-5">
        <label for="image_placeholder" class="text-sm font-bold text-[#3a281f]">Upload Gambar Produk</label>
        <input id="image_placeholder" name="image_placeholder" type="file" class="mt-3 block w-full text-sm text-[#755846] file:mr-4 file:rounded-md file:border-0 file:bg-[#b85f2f] file:px-4 file:py-2 file:text-sm file:font-bold file:text-white">
        <p class="mt-2 text-xs text-[#8a6a55]">UI ini siap untuk upload, tetapi backend upload gambar belum diaktifkan pada prototype.</p>
    </div>

    <label class="flex items-center gap-3 rounded-lg border border-[#eadcc8] bg-white p-4">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) class="rounded border-[#d8c4aa] text-[#b85f2f] focus:ring-[#b85f2f]">
        <span>
            <span class="block text-sm font-bold text-[#3a281f]">Produk aktif</span>
            <span class="block text-xs text-[#755846]">Produk aktif tampil di katalog publik.</span>
        </span>
    </label>
</div>
