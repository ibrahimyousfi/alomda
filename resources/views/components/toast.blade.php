<div 
    x-data="{ 
        notifications: [],
        add(message, type = 'success') {
            const id = Date.now();
            this.notifications.push({ id, message, type });
            setTimeout(() => {
                this.remove(id);
            }, 3000);
        },
        remove(id) {
            this.notifications = this.notifications.filter(notification => notification.id !== id);
        }
    }"
    @notify.window="add($event.detail.message, $event.detail.type)"
    class="fixed bottom-4 right-4 z-50 space-y-2"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            :class="{
                'bg-gold-600': notification.type === 'success',
                'bg-red-600': notification.type === 'error',
                'bg-blue-600': notification.type === 'info'
            }"
            class="text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 min-w-[300px]"
        >
            <svg x-show="notification.type === 'success'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <svg x-show="notification.type === 'error'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <span x-text="notification.message"></span>
        </div>
    </template>
</div>