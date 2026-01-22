<script setup lang="ts">
import { ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
// Use @ts-ignore if the path to ziggy varies in your local setup
// @ts-ignore
import { route } from '../../../../vendor/tightenco/ziggy';

defineProps<{
    title?: string;
    description?: string;
}>();

const page = usePage();
const search = ref('');

const handleSearch = () => {
    router.get('/', { search: search.value }, {
        preserveState: true,
        replace: true
    });
};

const logout = () => {
    // Calling the imported route function
    router.post(route('logout'));
};
</script>

<template>

    <div class="min-h-screen bg-background flex flex-col">
        <header
            class="fixed top-0 left-0 right-0 z-100 h-14 border-b bg-white dark:bg-[#0f0f0f] flex items-center px-4 justify-between">

            <div class="flex items-center gap-4 W-50">
                <Link href="/" class="flex items-center gap-2">
                    <AppLogoIcon class="size-8 fill-current text-red-600" />
                    <span class="font-bold text-xl tracking-tighter dark:text-white">YouTube</span>
                </Link>
            </div>

            <div class="flex-1 flex justify-center px-4">
                <form @submit.prevent="handleSearch" class="flex w-full mmax-w-150">
                    <input v-model="search" type="text" placeholder="Search"
                        class="w-full h-10 pl-4 rounded-l-full border dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 dark:text-white focus:outline-none" />
                    <button type="submit"
                        class="px-5 bg-gray-100 dark:bg-zinc-800 border border-l-0 dark:border-zinc-800 rounded-r-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-gray-600">
                            <path d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="flex items-center justify-end gap-3 w-fit">
                <template v-if="$page.props.auth.user">
                    <Link href="/videos/create" class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-800 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </Link>

                    <Link href="/dashboard" class="transition hover:opacity-80">
                        <div
                            class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold uppercase">
                            {{ $page.props.auth.user.name.charAt(0) }}
                        </div>
                    </Link>
                </template>

                <template v-else>
                    <Link href="/login"
                        class="px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-full hover:bg-blue-50">
                        Sign In
                    </Link>
                </template>
            </div>
        </header>

        <div class="flex flex-1 pt-14">
            <main class="flex-1 w-full">
                <slot />
            </main>
        </div>
    </div>
</template>
