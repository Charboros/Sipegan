<section>
    <header>
        <h2 class="text-lg font-bold text-slate-800">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi Saat Ini</label>
            <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
            <input type="password" id="update_password_password" name="password" autocomplete="new-password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg text-sm transition shadow-sm">
                Simpan Perubahan
            </button>

            @if (session('status') === 'password-updated')
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
