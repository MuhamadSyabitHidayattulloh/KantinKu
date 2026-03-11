@props(['items' => []])

<!-- Mobile Bottom Navigation -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 md:hidden z-40">
    <div class="flex justify-around items-center h-16">
        @foreach(['explore' => ['icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'label' => 'Jelajahi', 'route' => '/user/explore'], 'cart' => ['icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m12-8l2 8M9 5a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z', 'label' => 'Keranjang', 'route' => '/user/cart', 'badge' => true], 'orders' => ['icon' => 'M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V9a2 2 0 012-2h2m6-4h6a2 2 0 012 2v14a2 2 0 01-2 2h-6', 'label' => 'Pesanan', 'route' => '/user/orders']] as $key => $item)
            <a href="{{ $item['route'] }}" class="flex flex-col items-center justify-center w-full h-full relative group hover:bg-gray-50 transition">
                <svg class="w-6 h-6 @if(request()->is('user/' . $key . '*')) text-primary-700 @else text-gray-500 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                </svg>
                <span class="text-xs mt-0.5 @if(request()->is('user/' . $key . '*')) text-primary-700 font-semibold @else text-gray-600 @endif">{{ $item['label'] }}</span>
                @if(isset($item['badge']) && $item['badge'])
                    <span class="absolute top-1 right-1 w-4 h-4 bg-accent-600 text-white text-xs rounded-full flex items-center justify-center font-semibold">0</span>
                @endif
            </a>
        @endforeach
        <button onclick="toggleProfile()" class="flex flex-col items-center justify-center w-full h-full group hover:bg-gray-50 transition">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs mt-0.5 text-gray-600">Profil</span>
        </button>
    </div>
</nav>

<!-- Profile Menu Modal (Mobile) -->
<div id="profileMenu" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 md:hidden" onclick="toggleProfile()" style="display: none;">
    <div class="absolute bottom-16 left-0 right-0 bg-white rounded-t-2xl p-6 shadow-lg" onclick="event.stopPropagation()">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Budi Santoso</p>
                <p class="text-sm text-gray-600">Saldo: Rp 250.000</p>
            </div>
        </div>
        <div class="space-y-2">
            <button class="w-full px-4 py-3 hover:bg-gray-100 rounded-lg text-left text-gray-700 font-medium transition">
                ⚙️ Pengaturan
            </button>
            <button class="w-full px-4 py-3 hover:bg-gray-100 rounded-lg text-left text-gray-700 font-medium transition">
                💬 Bantuan
            </button>
            <button class="w-full px-4 py-3 hover:bg-red-50 rounded-lg text-left text-red-600 font-medium transition">
                🚪 Logout
            </button>
        </div>
    </div>
</div>

<script>
function toggleProfile() {
    const menu = document.getElementById('profileMenu');
    if (menu.style.display === 'none') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}
</script>
