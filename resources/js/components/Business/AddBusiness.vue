<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Add New Business</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Business Name</label>
                    <input type="text" v-model="name" id="name" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input type="email" v-model="email" id="email" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
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
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { fetchWithBearerToken } from '../fetchWithBearerToken';
    export default {
        setup() {
            const router = useRouter();
            const name = ref('');
            const email = ref('');
            const selectedTags = ref([]);
            const selectedCategories = ref([]);

            const submitForm = async () => {
                const payload = {
                    'name': name.value,
                    'email': email.value,
                    'tags': selectedTags.value,
                    'categories': selectedCategories.value
                }
                
                try {
                    await fetchWithBearerToken('/api/business', "POST", payload, {});
                    router.push('/business');
                } catch (error) {
                    console.error('There was an error adding a business!', error);
                }
            };
            return {
                name,
                email,
                selectedTags,
                selectedCategories,
                submitForm
            };
        },
        data() {
            return {
                'tags': [],
                'categories': []
            }
        },
        methods: {
            cancel() {
                this.$router.push('/business');
            },
            async getTags() {
                try {
                    const response = await fetchWithBearerToken('/api/tag', "GET", {}, {});
                    this.tags = response;
					
				} catch (error) {
					console.error('Unable to pull tags:', error);
				}
            },

            async getCategories() {
                try {
                    const response = await fetchWithBearerToken('/api/category', "GET", {}, {});
                    this.categories = response;
					
				} catch (error) {
					console.error('Unable to pull tags:', error);
				}
            }
        },
        mounted() {
			this.getCategories();
            this.getTags();
		}
    };
</script>