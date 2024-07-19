<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Add New Category</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" v-model="name" id="name" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button type="button" @click="cancel" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 transition duration-150 ease-in-out">Cancel</button>
                    <button type="submit" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script>
    export default {
        data() {
            return {
                "name": ''
            };
        },
        methods: {
            submitForm() {
                
                alert('Form submitted');
            },
            cancel() {
                this.$router.push('/categories');
            },
        },
    };
</script>