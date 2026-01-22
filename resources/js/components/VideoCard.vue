<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    video: {
        type: Object,
        required: true
    }
});

/**
 * Safe helper to generate route. Uses window.route to ensure it
 * doesn't conflict with local 'videos' variables.
 */
const getUrl = (id) => {
    try {
        return window.route('videos.show', id);
    } catch (e) {
        console.warn("Ziggy helper not ready, using fallback path.");
        return `/videos/${id}`;
    }
}
</script>

<template>
    <div class="group cursor-pointer w-full z-0">
        <Link v-if="video && video.id" :href="getUrl(video.id)">
            <div class="relative aspect-video overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
                <img :src="'/storage/' + video.thumbnail_path" class="w-full h-full object-cover" alt="Video Thumbnail"
                    @error="(e) => e.target.src = '/placeholder.jpg'" />
            </div>

            <div class="mt-3 flex gap-3">
                <div
                    class="h-9 w-9 shrink-0 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs">
                    {{ video.user?.name?.charAt(0) || '?' }}
                </div>

                <div class="flex-1 overflow-hidden">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-tight">
                        {{ video.title }}
                    </h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                        {{ video.user?.name || 'Loading...' }}
                    </p>
                    <div class="text-xs text-gray-500 flex gap-1 items-center">
                        <span>{{ video.views }} views</span>
                        <span class="text-[10px]">•</span>
                        <span>{{ video.created_at_human }}</span>
                    </div>
                </div>
            </div>
        </Link>
    </div>
</template>
