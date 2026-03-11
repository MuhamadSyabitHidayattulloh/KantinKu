@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-900 to-primary-800 p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Branding -->
        <div class="text-center mb-8">
            <h1 class="font-poppins text-4xl font-bold text-white mb-2">Kantinku</h1>
            <p class="text-primary-200">Jajan Jadi Mudah</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            @yield('auth-content')
        </div>

        <!-- Footer Links -->
        <div class="text-center mt-6 text-sm text-gray-600">
            @yield('auth-footer')
        </div>
    </div>
</div>
@endsection
