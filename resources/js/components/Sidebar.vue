<script setup>
import { Link } from '@inertiajs/vue3';
import { Home, PlaySquare, Clock, ThumbsUp, Film } from 'lucide-vue-next'; // Optional: install lucide-vue-next
</script>

<template>
    <aside class="w-64 hidden md:block bg-white dark:bg-[#0f0f0f] fixed left-0 top-14 bottom-0 overflow-y-auto px-3 py-4 border-r border-gray-100 dark:border-gray-800">
        <div class="space-y-1">
            <Link href="/" class="flex items-center gap-5 p-3 rounded-xl bg-gray-100 dark:bg-gray-800 font-medium">
                <Home class="w-5 h-5" /> <span>Home</span>
            </Link>
            <Link href="#" class="flex items-center gap-5 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <Film class="w-5 h-5" /> <span>Shorts</span>
            </Link>
        </div>

        <hr class="my-4 border-gray-100 dark:border-gray-800" />

        <div class="space-y-1">
            <h3 class="px-3 text-sm font-semibold mb-2">You</h3>
            <Link href="#" class="flex items-center gap-5 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <PlaySquare class="w-5 h-5" /> <span>Your videos</span>
            </Link>
            <Link href="#" class="flex items-center gap-5 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <Clock class="w-5 h-5" /> <span>History</span>
            </Link>
            <Link href="#" class="flex items-center gap-5 p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <ThumbsUp class="w-5 h-5" /> <span>Liked videos</span>
            </Link>
        </div>
    </aside>
</template>
