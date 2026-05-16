<section>
    <header>
        <h2 class="text-xl font-extrabold text-[#2f221b]">Update Password</h2>
        <p class="mt-1 text-sm text-[#755846]">Gunakan password yang kuat untuk menjaga akun tetap aman.</p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 max-w-xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="update_password_current_password" class="text-sm font-bold text-[#3a281f]">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            @foreach ($errors->updatePassword->get('current_password') as $message)
                <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <label for="update_password_password" class="text-sm font-bold text-[#3a281f]">Password Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            @foreach ($errors->updatePassword->get('password') as $message)
                <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <label for="update_password_password_confirmation" class="text-sm font-bold text-[#3a281f]">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Simpan Password</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm font-semibold text-emerald-700">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
