<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Add New Business</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Business Name</label>
                    <input type="text" v-model="businessName" id="name" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input type="email" v-model="businessDescription" id="email" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700">Tags</label>
                        <div class="mt-1">
                            <div v-for="tag in tags" :key="tag.id" class="flex items-center">
                            <input type="checkbox" :id="`tag-${tag.id}`" v-model="selectedTags" :value="tag.id" class="mr-2">
                            <label :for="`tag-${tag.id}`" class="text-sm text-gray-700">{{ tag.name }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700">Categories</label>
                        <div class="mt-1">
                            <div v-for="category in categories" :key="category.id" class="flex items-center">
                            <input type="checkbox" :id="`category-${category.id}`" v-model="selectedCategories" :value="category.id" class="mr-2">
                            <label :for="`category-${category.id}`" class="text-sm text-gray-700">{{ category.name }}</label>
                            </div>
                        </div>
                    </div>
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
                businessName: '',
                businessDescription: '',
                selectedTags: [],
                selectedCategories: [],
                tags: [
                { id: 1, name: 'Technology' },
                { id: 2, name: 'Health' },
                { id: 3, name: 'Finance' },
                // Add more tags as needed
                ],
                categories: [
                { id: 1, name: 'Startup' },
                { id: 2, name: 'Enterprise' },
                { id: 3, name: 'Non-Profit' },
                // Add more categories as needed
                ],
            };
        },
        methods: {
            submitForm() {
                // Add your form submission logic here
                console.log('Business Name:', this.businessName);
                console.log('Business Description:', this.businessDescription);
                console.log('Selected Tags:', this.selectedTags);
                console.log('Selected Categories:', this.selectedCategories);
                alert('Form submitted');
            },
            cancel() {
                this.$router.push('/business');
            },
        },
    };
</script>