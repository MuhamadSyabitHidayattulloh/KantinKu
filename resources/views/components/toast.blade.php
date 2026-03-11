<div id="toast" class="fixed bottom-6 right-6 z-50"></div>

<script>
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');

    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    const toastHtml = `
        <div class="flex items-center gap-3 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg animate-in slide-in-from-right-6 duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16${type === 'success' ? 'zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' : ''}"/>
            </svg>
            <span>${message}</span>
        </div>
    `;

    toast.innerHTML = toastHtml;
    toast.style.display = 'block';

    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

// Show toast from session
@if (session('success'))
    showToast('{{ session('success') }}', 'success');
@endif

@if (session('error'))
    showToast('{{ session('error') }}', 'error');
@endif
</script>
