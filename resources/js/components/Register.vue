
<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-200 to-gray-400">
        <div class="max-w-md w-full bg-white p-10 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6 text-[#cf2e2e]">Register</h2>
            <form @submit.prevent="register">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" v-model="name" id="text" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" v-model="email" id="email" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" v-model="password" id="password" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <div class="mb-6">
                    <label for="confirmPassword" class="block text-gray-700">Confirm Password</label>
                    <input type="password" v-model="confirmPassword" id="confirmPassword" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <button type="submit" class="w-full bg-[#cf2e2e] text-white py-3 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Register</button>
            </form>
            <p class="mt-6 text-center text-gray-700">
                Already registered? <router-link to="/login" class="text-[#cf2e2e] hover:underline">Login</router-link>
            </p>
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    export default {
        setup() {
            const router = useRouter();
            const name = ref('');
            const email = ref('');
            const password = ref('');
            const confirmPassword = ref('');
            const errors = ref({
                password: '',
                confirmPassword: '',
            });

            const register = async () => {
                if (password.value === confirmPassword.value) {
                    const payload = {
                        'name': name.value,
                        'email': email.value,
                        'password': password.value
                    }
                    try {
                        const response = await fetch('/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                            body: JSON.stringify(payload),
                        });

                        if (!response.ok) {
                            throw new Error('Unable to register user');
                        }
                        
                        router.push('/login');
                    } catch (error) {
                        console.error('There was an error registering user!', error);
                    }
                }
                else {
                    alert("Password and Confirm Password doesn't match");
                }
                
            }
            return {
                name,
                email,
                password,
                confirmPassword,
                errors,
                register,
            };
        }
    }
</script>