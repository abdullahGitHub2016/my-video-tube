<script setup lang="ts">
import AuthSimpleLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    video: null as File | null,
});

const submit = () => {
    form.post('/videos', {
        forceFormData: true,
        preserveScroll: true,
        onFinish: () => {
            // Optional: reset file input if needed
        }
    });
};
</script>

<template>
    <AuthSimpleLayout>
        <Head title="Upload Video" />
        <div class="max-w-2xl mx-auto py-10 px-4">
            <form @submit.prevent="submit" class="flex flex-col gap-6 bg-white dark:bg-zinc-900 p-8 rounded-xl shadow">
                <div>
                    <label class="block mb-2 font-medium dark:text-white">Title</label>
                    <input v-model="form.title" type="text" class="w-full border rounded-lg p-2 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white" placeholder="Enter video title" />
                    <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
                </div>

                <div>
                    <label class="block mb-2 font-medium dark:text-white">Video File</label>
                    <input type="file" @input="form.video = ($event.target as HTMLInputElement).files?.[0] || null"
                        accept="video/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p v-if="form.errors.video" class="text-red-500 text-sm mt-1">{{ form.errors.video }}</p>
                </div>

                <div v-if="form.progress" class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: `${form.progress.percentage}%` }"></div>
                    <p class="text-xs text-center mt-1">{{ form.progress.percentage }}%</p>
                </div>

                <button type="submit" :disabled="form.processing" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full disabled:opacity-50">
                    {{ form.processing ? 'Publishing...' : 'Publish' }}
                </button>
            </form>
        </div>
    </AuthSimpleLayout>
</template>
