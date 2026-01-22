<script setup>
import AuthenticatedLayout from '@/layouts/AuthLayout.vue';
import VideoCard from '@/components/VideoCard.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    video: Object,
    relatedVideos: Array
});
</script>

<template>

    <Head :title="video.title" />

    <AuthenticatedLayout>
        <div class="flex flex-col lg:flex-row gap-6 p-4 md:p-6 lg:px-12 max-w-450 mx-auto">

            <div class="flex-1">
                <div class="aspect-video bg-black rounded-xl overflow-hidden shadow-lg">
                    <video :src="'/storage/' + video.video_path + '#t=0.1'" controls autoplay preload="metadata"
                        class="w-full h-full bg-black"></video>
                </div>

                <h1 class="text-xl font-bold mt-4 text-gray-900 dark:text-white">
                    {{ video.title }}
                </h1>

                <div class="mt-4 flex items-center justify-between border-b pb-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                            {{ video.user?.name?.charAt(0) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white leading-none">
                                {{ video.user?.name }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">1.2M subscribers</p>
                        </div>
                        <button
                            class="ml-4 bg-black dark:bg-white text-white dark:text-black px-4 py-2 rounded-full text-sm font-medium">
                            Subscribe
                        </button>
                    </div>

                    <div class="flex gap-2">
                        <button
                            class="bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full text-sm font-medium flex items-center gap-2">
                            👍 {{ video.likes_count || 0 }}
                        </button>
                        <button class="bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full text-sm font-medium">
                            Share
                        </button>
                    </div>
                </div>

                <div class="mt-4 bg-gray-100 dark:bg-gray-800 rounded-xl p-3 text-sm">
                    <p class="font-bold">{{ video.views }} views • {{ video.created_at_human }}</p>
                    <p class="mt-2 whitespace-pre-wrap">{{ video.description }}</p>
                </div>
            </div>

            <div class="w-full lg:w-96 space-y-4">
                <h2 class="font-bold text-gray-900 dark:text-white">Up Next</h2>
                <div v-for="related in relatedVideos" :key="related.id" class="flex gap-2 group cursor-pointer">
                    <div class="w-40 h-24 shrink-0 rounded-lg overflow-hidden bg-gray-200">
                        <img :src="related.thumbnail_path" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h3 class="text-sm font-semibold line-clamp-2 leading-tight">
                            {{ related.title }}
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">{{ related.user?.name }}</p>
                        <p class="text-xs text-gray-500">{{ related.views }} views</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
