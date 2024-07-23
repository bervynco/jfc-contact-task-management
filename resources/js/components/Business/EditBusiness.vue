<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Edit Business</h2>
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
    import { ref, onMounted } from 'vue';
    import { useRouter } from 'vue-router';
    export default {
        props: {
            id: {
                type: String,
                required: true
            }
        },
        setup(props) {
            const router = useRouter();
            const name = ref('');
            const email = ref('');
            const selectedTags = ref([]);
            const selectedCategories = ref([]);
            let business = ref([]);
            let tags = ref([]);
            let categories = ref([]);

            const submitForm = async () => {
                const payload = {
                    'name': name.value,
                    'email': email.value,
                    'tags': selectedTags.value,
                    'categories': selectedCategories.value
                }

                 try {
                    const response = await fetch(`/api/business/${props.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                        body: JSON.stringify(payload),
                    });

                    if (!response.ok) {
                        throw new Error('Unable to add business');
                    }
                    
                    router.push('/business');
                } catch (error) {
                    console.error('There was an error adding a business!', error);
                }
            };

            const reinitializeForm = (business) => {
                name.value = business.name;
                email.value = business.email;
                business.value = business;
                selectedTags.value = business.tags.map(tag => tag.id);
                selectedCategories.value = business.categories.map(category => category.id);
            };

            const getBusiness = async () => {
                 try {
                    const response = await fetch(`/api/business/${props.id}`)

                    if (!response.ok) {
                        throw new Error('Unable to get business data');
                    }
                    const data = await response.json();
                    reinitializeForm(data.data);
                } catch (error) {
                    console.error('There was an error pulling a business!', error);
                }
            }

            const getAllTags = async () => {
                try {
					const response = await fetch('/api/tag');
					if (!response.ok) {
                        throw new Error('Unable to pull tags');
					}
                    const data = await response.json();
                    tags.value = data;
					
					
				} catch (error) {
					console.error('Unable to pull tags:', error);
				}
            }

            const getAllCategories = async () => {
                try {
					const response = await fetch('/api/category');
					if (!response.ok) {
                        throw new Error('Unable to pull categories');
					}
                    const data = await response.json();
                    categories.value = data;
					
				} catch (error) {
					console.error('Unable to pull categories:', error);
				}
            }

            onMounted(() => {
                getBusiness();
                getAllCategories();
                getAllTags();
            });

            return {
                name,
                email,
                selectedTags,
                selectedCategories,
                submitForm,
                tags,
                categories
            };
        },
        data() {
            return {
            }
        },
        methods: {
            cancel() {
                this.$router.push('/business');
            }
        },
        mounted() {
		}
    };
</script>