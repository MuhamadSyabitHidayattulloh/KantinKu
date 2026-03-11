@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-primary-900 text-white shadow-lg overflow-y-auto">
        <!-- Logo Section -->
        <div class="p-6 border-b border-primary-700">
            <h1 class="font-poppins text-2xl font-bold">Kantinku</h1>
            <p class="text-primary-200 text-sm">@yield('sidebar-subtitle')</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4">
            <ul class="space-y-2">
                @yield('sidebar-menu')
            </ul>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-primary-700 bg-primary-800 w-64">
            @yield('sidebar-footer')
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
            <div class="px-8 py-4 flex justify-between items-center">
                <h2 class="font-poppins text-2xl font-bold text-gray-800">@yield('page-title')</h2>
                <div class="flex items-center gap-4">
                    @yield('header-actions')
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-8">
            @yield('content')
        </div>
    </main>
</div>

<!-- Reusable Components -->
<style>
    .nav-item {
        @apply px-4 py-3 rounded-lg transition duration-200 text-primary-100 hover:bg-primary-700 hover:text-white flex items-center gap-3;
    }

    .nav-item.active {
        @apply bg-accent-600 text-white;
    }

    .btn-primary {
        @apply px-6 py-2 rounded-lg bg-primary-700 text-white font-medium hover:bg-primary-800 transition;
    }

    .btn-accent {
        @apply px-6 py-2 rounded-lg bg-accent-600 text-white font-medium hover:bg-accent-700 transition;
    }

    .btn-secondary {
        @apply px-6 py-2 rounded-lg bg-gray-200 text-gray-800 font-medium hover:bg-gray-300 transition;
    }

    .card {
        @apply bg-white rounded-xl shadow-md p-6 border border-gray-100;
    }

    .card-header {
        @apply pb-4 border-b border-gray-200 mb-4;
    }

    .input-field {
        @apply w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200 transition;
    }

    .table-responsive {
        @apply overflow-x-auto;
    }

    .table {
        @apply w-full text-sm text-gray-600;
    }

    .table thead {
        @apply bg-gray-100 text-gray-800 font-semibold;
    }

    .table th {
        @apply px-6 py-3 text-left;
    }

    .table td {
        @apply px-6 py-3 border-t border-gray-200;
    }

    .badge {
        @apply inline-block px-3 py-1 rounded-full text-xs font-semibold;
    }

    .badge-success {
        @apply bg-green-100 text-green-800;
    }

    .badge-warning {
        @apply bg-yellow-100 text-yellow-800;
    }

    .badge-danger {
        @apply bg-red-100 text-red-800;
    }

    .badge-info {
        @apply bg-blue-100 text-blue-800;
    }
</style>

@yield('extra-js')
@endsection
