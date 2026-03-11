@extends('layouts.auth')

@section('auth-content')
<!-- Segmented Tabs -->
<div class="flex border-b border-gray-300">
    <a href="/login" class="flex-1 py-4 text-center font-medium border-b-2 border-primary-700 text-primary-700">
        Masuk
    </a>
    <a href="/register" class="flex-1 py-4 text-center font-medium text-gray-500 hover:text-gray-700">
        Daftar
    </a>
</div>

<!-- Login Form -->
<div class="p-8">
    <form action="{{ route('auth.login') }}" method="POST" class="space-y-5">
        @csrf
        
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm text-red-600">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Email Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" placeholder="nama@example.com" class="input-field w-full px-4 py-3 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
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

        <!-- Remember Me & Forgot Password -->
        <div class="flex justify-between items-center text-sm">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300">
                <span class="text-gray-600">Ingat saya</span>
            </label>
            <a href="#" class="text-primary-700 hover:text-primary-800 font-medium">Lupa password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full py-3 bg-primary-700 text-white font-medium rounded-lg hover:bg-primary-800 transition duration-200">
            Masuk
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

        <!-- Social Login -->
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
Belum punya akun? <a href="/register" class="text-primary-700 font-semibold hover:underline">Daftar di sini</a>
@endsection

@section('auth-footer')
Belum punya akun? <a href="/register" class="text-primary-700 font-semibold hover:underline">Daftar sekarang</a>
@endsection
