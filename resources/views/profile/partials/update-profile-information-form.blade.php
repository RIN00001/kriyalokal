<section>
    <header>
        <h2 class="text-xl font-extrabold text-[#2f221b]">Informasi Profil</h2>
        <p class="mt-1 text-sm text-[#755846]">Perbarui nama dan email akun KriyaLokal.</p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 max-w-xl space-y-5">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="text-sm font-bold text-[#3a281f]">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <x-form-error name="name" />
        </div>

        <div>
            <label for="email" class="text-sm font-bold text-[#3a281f]">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            <x-form-error name="email" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-[#755846]">
                    Email belum terverifikasi.
                    <button form="send-verification" class="font-bold text-[#9c4f26] hover:underline">Kirim ulang verifikasi</button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-semibold text-emerald-700">Tautan verifikasi baru sudah dikirim.</p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Simpan Profil</button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm font-semibold text-emerald-700">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
