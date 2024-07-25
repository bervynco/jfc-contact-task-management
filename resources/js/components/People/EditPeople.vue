<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-[#cf2e2e] mb-6 text-center">Edit People</h2>
            <form @submit.prevent="submitForm">
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" v-model="firstname" id="firstname" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" v-model="lastname" id="lastname" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" v-model="email" id="email" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="number" v-model="phone" id="phone" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full" required>
                </div>
                <div class="mb-4">
                    <label for="business" class="block text-sm font-medium text-gray-700">Business</label>
                    <select v-model="selectedBusiness" id="business" class="mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e] w-full">
                        <option v-for="business in businesses" :key="business.id" :value="business.id">
                            {{ business.name }}
                        </option>
                    </select>
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
    import { fetchWithBearerToken } from '../fetchWithBearerToken';
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
            const firstname = ref('');
            const lastname = ref('');
            const phone = ref('');
            const email = ref('');
            const selectedTags = ref([]);
            const selectedBusiness = ref([]);
            let people = ref([]);
            let businesses = ref([]);
            let tags = ref([]);
            
            const reinitializeForm = (peopleData) => {
                people.value = peopleData;
                console.log(peopleData);
                firstname.value = peopleData.firstname;
                lastname.value = peopleData.lastname;
                email.value = peopleData.email;
                phone.value = peopleData.phone;
                selectedBusiness.value = peopleData.business_id;
                selectedTags.value = peopleData.tags.map(tag => tag.id);
            }
            const submitForm = async () => {
                const payload = {
                    'firstname': firstname.value,
                    'lastname': lastname.value,
                    'email': email.value,
                    'phone': phone.value,
                    'business_id': selectedBusiness.value,
                    'tags': selectedTags.value
                }
                 try {
                    await fetchWithBearerToken(`/api/people/${props.id}`, "PUT", payload, {});                  
                    router.push('/people');
                } catch (error) {
                    console.error('There was an error adding people!', error);
                }
            };

            const getPeople = async() => {
                try {
                    const response = await fetchWithBearerToken(`/api/people/${props.id}`, "GET", {}, {});
					reinitializeForm(response.data);
					
				} catch (error) {
					console.error('Unable to pull business:', error);
				}
            }
            const getAllBusinesses = async () => {
                try {
                    const response = await fetchWithBearerToken('/api/business', "GET", {}, {});
                    businesses.value = response.data;
					
					
				} catch (error) {
					console.error('Unable to pull business:', error);
				}
            }

            const getAllTags = async () => {
                try {
                    const response = await fetchWithBearerToken('/api/tag', "GET", {}, {});
                    tags.value = response;
					
					
				} catch (error) {
					console.error('Unable to pull tags:', error);
				}
            }

            onMounted(() => {
                getPeople();
                getAllBusinesses();
                getAllTags();
            });
            return {
                firstname,
                lastname,
                phone,
                email,
                selectedTags,
                selectedBusiness,
                businesses,
                tags,
                submitForm
            };
        },
        data() {
            return {}
        },
        methods: {
            cancel() {
                this.$router.push('/people');
            }
        },
        mounted() {
		}
    };
</script>