<div x-data="{ show: @entangle('visible') }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg" style="display: none;" x-init="
        window.addEventListener('hide-notification', event => {
            setTimeout(() => show = false, event.detail.timeout);
        });
    ">
    {{ $message }}
</div>