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
    <form action="{{ route('auth.register') }}" method="POST" class="space-y-5">
        @csrf

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm text-red-600">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Name Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Nama anda" class="input-field w-full px-4 py-3 @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" placeholder="nama@example.com" class="input-field w-full px-4 py-3 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Daftar sebagai</label>
            <div class="space-y-2">
                <label class="flex items-center gap-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-primary-50 @error('role') border-red-500 @enderror"
                    :class="selectedRole === 'user' && 'border-primary-700 bg-primary-50'">
                    <input type="radio" name="role" value="user" class="w-4 h-4 text-primary-700" checked>
                    <div>
                        <p class="font-medium text-gray-900">Pembeli</p>
                        <p class="text-sm text-gray-600">Beli makanan dari vendor</p>
                    </div>
                </label>

                <label class="flex items-center gap-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-accent-50"
                    :class="selectedRole === 'vendor' && 'border-accent-600 bg-accent-50'">
                    <input type="radio" name="role" value="vendor" class="w-4 h-4 text-accent-600">
                    <div>
                        <p class="font-medium text-gray-900">Vendor</p>
                        <p class="text-sm text-gray-600">Jual makanan dan minuman</p>
                    </div>
                </label>
            </div>
            @error('role')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input type="password" name="password" placeholder="••••••••" class="input-field w-full px-4 py-3 @error('password') border-red-500 @enderror" required>
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="••••••••" class="input-field w-full px-4 py-3" required>
        </div>

        <!-- Terms -->
        <div class="flex items-start gap-2">
            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 mt-1" required>
            <span class="text-sm text-gray-600">
                Saya setuju dengan <a href="#" class="text-primary-700 hover:underline">syarat dan ketentuan</a> 
                serta <a href="#" class="text-primary-700 hover:underline">kebijakan privasi</a>
            </span>
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full py-3 bg-primary-700 text-white font-medium rounded-lg hover:bg-primary-800 transition duration-200">
            Daftar
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
@endsection

@section('auth-footer')
Sudah punya akun? <a href="/login" class="text-primary-700 font-semibold hover:underline">Masuk di sini</a>
@endsection
