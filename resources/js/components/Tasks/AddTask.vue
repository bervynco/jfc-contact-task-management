<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Add New Task</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                    <input type="text" v-model="name" id="name" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="mb-4">
                    <label for="business" class="block text-sm font-medium text-gray-700">Business</label>
                    <select v-model="selectedBusiness" id="business" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full">
                        <option v-for="business in businesses" :key="business.id" :value="business.id">
                            {{ business.name }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="people" class="block text-sm font-medium text-gray-700">People</label>
                    <select v-model="selectedPeople" id="people" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full">
                        <option v-for="person in people" :key="person.id" :value="person.id">
                            {{ person.firstname }} {{ person.lastname }}
                        </option>
                    </select>
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
    import { fetchWithBearerToken } from '../fetchWithBearerToken';
    export default {
        setup() {
            const router = useRouter();
            const name = ref('');
            const selectedPeople = ref(null);
            const selectedBusiness = ref(null);
            let businesses = ref([]);
            let people = ref([]);
            const submitForm = async () => {
                const payload = {
                    'name': name.value,
                    'business_id': selectedBusiness.value,
                    'people_id': selectedPeople.value
                }
                try {
                    await fetchWithBearerToken('/api/tasks', "POST", payload, {});
                    router.push('/tasks');
                } catch (error) {
                    console.error('There was an error adding task!', error);
                }
            };
            const getAllBusinesses = async () => {
                try {
                    const response = await fetchWithBearerToken('/api/business', "GET", {}, {});
                    businesses.value = response.data;
					
					
				} catch (error) {
					console.error('Unable to pull business:', error); 
				}
            }
            const getAllPeople = async () => {
                try {
                    const response = await fetchWithBearerToken('/api/people', "GET", {}, {});
                    people.value = response.data;
					
					
				} catch (error) {
					console.error('Unable to pull business:', error);
				}
            }
            onMounted(() => {
                getAllBusinesses();
                getAllPeople();
            });
            return {
                submitForm,
                name,
                selectedPeople,
                selectedBusiness,
                businesses,
                people
            }
        },
        data() {
            return {};
        },
        methods: {
            cancel() {
                this.$router.push('/tasks');
            },
        }
    };
</script>