<section>
    <header>
        <h2 class="text-xl font-extrabold text-red-800">Hapus Akun</h2>
        <p class="mt-1 text-sm leading-6 text-[#755846]">Aksi ini permanen. Masukkan password untuk menghapus akun dan data yang terkait.</p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 max-w-xl space-y-5">
        @csrf
        @method('DELETE')

        <div>
            <label for="delete_password" class="text-sm font-bold text-[#3a281f]">Password</label>
            <input id="delete_password" name="password" type="password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-red-700 focus:ring-red-700">
            @foreach ($errors->userDeletion->get('password') as $message)
                <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
            @endforeach
        </div>

        <button type="submit" class="rounded-md bg-red-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-800">Hapus Akun</button>
    </form>
</section>
