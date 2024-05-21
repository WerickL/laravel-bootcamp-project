<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import ItemTask  from "@/Components/Task/Item.vue"
defineProps(['tasks']);
const form = useForm({
    description: '',
});
</script>
 
<template>
    <Head title="Tasks" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('tasks.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.description"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Create Task</PrimaryButton>
            </form>
            
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <ItemTask
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>