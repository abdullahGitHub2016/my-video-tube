<script setup>
import AuthSimpleLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import VideoCard from '@/components/VideoCard.vue';
import { Head } from '@inertiajs/vue3';

// Adding a default empty array [] prevents the .length crash
const props = defineProps({
    videos: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <Head title="Home" />

    <AuthSimpleLayout>
        <div class="p-4 md:p-6 lg:p-8">
            <div v-if="videos && videos.length > 0"
                 class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-x-4 gap-y-10">

                <VideoCard
                    v-for="video in videos"
                    :key="video.id"
                    :video="video"
                />
            </div>

            <div v-else class="flex flex-col items-center justify-center mt-20">
                <div class="text-gray-400 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">No videos found</h3>
                <p class="text-gray-500">Try searching for something else or upload a video.</p>
            </div>
        </div>
    </AuthSimpleLayout>
</template>
