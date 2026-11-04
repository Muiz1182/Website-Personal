<div 
    x-data="{
        toasts: [],
        nextId: 1,
        add(message, type = 'success', duration = 4500) {
            if (!message) return;
            const id = this.nextId++;
            const toast = {
                id,
                message,
                type,
                duration,
                remaining: duration,
                timer: null,
                started: null,
                paused: false
            };
            this.toasts.push(toast);
            this.startTimer(toast);
        },
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                if (this.toasts[index].timer) {
                    clearTimeout(this.toasts[index].timer);
                }
                this.toasts.splice(index, 1);
            }
        },
        startTimer(toast) {
            toast.started = Date.now();
            toast.timer = setTimeout(() => {
                this.remove(toast.id);
            }, toast.remaining);
        },
        pauseTimer(toast) {
            if (toast.timer && !toast.paused) {
                clearTimeout(toast.timer);
                toast.remaining -= (Date.now() - toast.started);
                toast.paused = true;
            }
        },
        resumeTimer(toast) {
            if (toast.paused) {
                toast.paused = false;
                this.startTimer(toast);
            }
        }
    }"
    x-init="
        window.toast = (msg, type = 'success', duration = 4500) => {
            add(msg, type, duration);
        };
        window.addEventListener('toast-notify', (e) => {
            const d = e.detail || {};
            add(d.message || d.msg || '', d.type || 'success', d.duration || 4500);
        });

        // Flash session integration
        @if(session('success'))
            add({{ json_encode(session('success')) }}, 'success', 5000);
        @endif
        @if(session('status'))
            add({{ json_encode(session('status')) }}, 'success', 4500);
        @endif
        @if(session('error'))
            add({{ json_encode(session('error')) }}, 'error', 6000);
        @endif
        @if(session('warning'))
            add({{ json_encode(session('warning')) }}, 'warning', 5000);
        @endif
        @if(session('info'))
            add({{ json_encode(session('info')) }}, 'info', 4500);
        @endif
    "
    class="fixed top-6 right-6 z-[100] flex flex-col space-y-3 pointer-events-none max-w-sm sm:max-w-md w-full px-4 sm:px-0"
    role="status"
    aria-live="polite"
    aria-atomic="false"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-4"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @mouseenter="pauseTimer(toast)"
            @mouseleave="resumeTimer(toast)"
            :class="{
                'border-[#10B981]/50 shadow-emerald-950/40': toast.type === 'success',
                'border-[#EF4444]/50 shadow-red-950/40': toast.type === 'error',
                'border-[#F59E0B]/50 shadow-amber-950/40': toast.type === 'warning',
                'border-[#3B82F6]/50 shadow-blue-950/40': toast.type === 'info'
            }"
            class="pointer-events-auto relative w-full bg-[#121215]/95 border shadow-2xl backdrop-blur-md p-4 flex items-start space-x-3.5 transition-all select-none overflow-hidden"
        >
            <!-- Left Accent Indicator Bar -->
            <div 
                :class="{
                    'bg-[#10B981]': toast.type === 'success',
                    'bg-[#EF4444]': toast.type === 'error',
                    'bg-[#F59E0B]': toast.type === 'warning',
                    'bg-[#3B82F6]': toast.type === 'info'
                }"
                class="absolute left-0 top-0 bottom-0 w-1"
            ></div>

            <!-- Icon -->
            <div class="shrink-0 mt-0.5">
                <!-- Success Icon -->
                <template x-if="toast.type === 'success'">
                    <div class="w-6 h-6 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-[#10B981]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </template>

                <!-- Error Icon -->
                <template x-if="toast.type === 'error'">
                    <div class="w-6 h-6 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center text-[#EF4444]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </template>

                <!-- Warning Icon -->
                <template x-if="toast.type === 'warning'">
                    <div class="w-6 h-6 rounded-full bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-[#F59E0B]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </template>

                <!-- Info Icon -->
                <template x-if="toast.type === 'info'">
                    <div class="w-6 h-6 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-[#3B82F6]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </template>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0 pr-2">
                <p 
                    class="text-xs uppercase tracking-wider font-bold mb-0.5"
                    :class="{
                        'text-emerald-400': toast.type === 'success',
                        'text-red-400': toast.type === 'error',
                        'text-amber-400': toast.type === 'warning',
                        'text-blue-400': toast.type === 'info'
                    }"
                    x-text="toast.type === 'success' ? 'Sukses' : (toast.type === 'error' ? 'Peringatan' : (toast.type === 'warning' ? 'Perhatian' : 'Informasi'))"
                ></p>
                <p class="text-xs text-neutral-200 leading-relaxed font-medium" x-text="toast.message"></p>
            </div>

            <!-- Close Button -->
            <button 
                type="button" 
                @click="remove(toast.id)"
                aria-label="Tutup notifikasi"
                class="shrink-0 text-neutral-400 hover:text-white transition-colors p-1 rounded focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF5722]"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

