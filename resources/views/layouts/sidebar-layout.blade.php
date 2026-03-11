@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.sidebar :subtitle="$sidebarSubtitle ?? ''">
        {{ $sidebarContent ?? '' }}
    </x-layout.sidebar>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <!-- Top Header -->
        <x-layout.page-header :title="$pageTitle ?? ''">
            {{ $headerActions ?? '' }}
        </x-layout.page-header>

        <!-- Page Content -->
        <div class="flex-1 p-8 overflow-auto">
            {{ $slot }}
        </div>
    </main>
</div>
@endsection
