@extends('layouts.auth')

@section('auth-content')
<!-- Unavailable Message -->
<div class="p-8 flex flex-col items-center justify-center min-h-96">
    <div class="text-center">
        <div class="mb-4">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="font-poppins text-2xl font-bold text-gray-800 mb-2">Halaman Belum Tersedia</h2>
        <p class="text-gray-600 mb-6">Pendaftaran user dan vendor dikelola oleh admin melalui halaman kelola user dan vendor</p>
        <a href="/login" class="inline-block px-6 py-3 bg-primary-700 text-white font-medium rounded-lg hover:bg-primary-800 transition duration-200">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection

@section('auth-footer')
Sudah punya akun? <a href="/login" class="text-primary-700 font-semibold hover:underline">Masuk di sini</a>
@endsection
