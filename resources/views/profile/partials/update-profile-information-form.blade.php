<section>
    <header>
        <h2 class="text-lg font-bold text-slate-800">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi profil akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="username" class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required autofocus class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg text-sm transition shadow-sm">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium"
                >Berhasil disimpan.</p>
            @endif
        </div>
    </form>
</section>
