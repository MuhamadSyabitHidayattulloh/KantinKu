@extends('layouts.auth')

@section('auth-content')
<!-- Segmented Tabs -->
<div class="flex border-b border-gray-300">
    <a href="/login" class="flex-1 py-4 text-center font-medium text-gray-500 hover:text-gray-700">
        Masuk
    </a>
    <a href="/register" class="flex-1 py-4 text-center font-medium border-b-2 border-primary-700 text-primary-700">
        Daftar
    </a>
</div>

<!-- Register Form -->
<div class="p-8">
    <!-- Role Selection -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-3">Daftar Sebagai</label>
        <div class="grid grid-cols-3 gap-3">
            <label class="relative flex items-center cursor-pointer">
                <input type="radio" name="role" value="user" checked class="w-4 h-4">
                <span class="ml-2 text-sm text-gray-700">Pembeli</span>
            </label>
            <label class="relative flex items-center cursor-pointer">
                <input type="radio" name="role" value="vendor" class="w-4 h-4">
                <span class="ml-2 text-sm text-gray-700">Penjual</span>
            </label>
        </div>
    </div>

    <form class="space-y-4">
        <!-- Full Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" placeholder="Nama anda" class="input-field w-full px-4 py-3" required>
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" placeholder="nama@example.com" class="input-field w-full px-4 py-3" required>
        </div>

        <!-- Phone (for vendors) -->
        <div id="phone-field" class="hidden">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
            <input type="tel" placeholder="08xxxxxxxxxx" class="input-field w-full px-4 py-3">
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input type="password" placeholder="••••••••" class="input-field w-full px-4 py-3" required>
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" placeholder="••••••••" class="input-field w-full px-4 py-3" required>
        </div>

        <!-- Terms & Conditions -->
        <label class="flex items-start gap-3 cursor-pointer">
            <input type="checkbox" class="w-4 h-4 mt-1" required>
            <span class="text-sm text-gray-600">Saya setuju dengan <a href="#" class="text-primary-700 font-medium">Syarat & Ketentuan</a> dan <a href="#" class="text-primary-700 font-medium">Kebijakan Privacy</a></span>
        </label>

        <!-- Register Button -->
        <button type="submit" class="w-full py-3 bg-primary-700 text-white font-medium rounded-lg hover:bg-primary-800 transition duration-200 mt-6">
            Daftar Sekarang
        </button>

        <!-- Divider -->
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">atau</span>
            </div>
        </div>

        <!-- Social Register -->
        <button type="button" class="w-full py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032 c0-3.331,2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.461,2.268,15.365,1,12.545,1 C6.777,1,2,5.777,2,11.545c0,5.769,4.777,10.545,10.545,10.545c6.032,0,10.545-4.513,10.545-10.545 C23.091,11.804,23.026,10.968,22.889,10.239H12.545z"/>
            </svg>
            <span class="text-gray-700 font-medium">Google</span>
        </button>
    </form>
</div>

<script>
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const phoneField = document.getElementById('phone-field');
            if (this.value === 'vendor') {
                phoneField.classList.remove('hidden');
            } else {
                phoneField.classList.add('hidden');
            }
        });
    });
</script>
@endsection

@section('auth-footer')
Sudah punya akun? <a href="/login" class="text-primary-700 font-semibold hover:underline">Masuk di sini</a>
@endsection
