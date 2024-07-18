<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-200 to-gray-400">
        <div class="max-w-md w-full bg-white p-10 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6 text-[#cf2e2e]">Login</h2>
            <form @submit.prevent="handleLogin">
                <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" v-model="email" id="email" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" v-model="password" id="password" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]" required>
                </div>
                <button type="submit" class="w-full bg-[#cf2e2e] text-white py-3 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Login</button>
            </form>
            <p class="mt-6 text-center text-gray-700">
                Don't have an account? <router-link to="/register" class="text-[#cf2e2e] hover:underline">Register</router-link>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        handleLogin() {
            // Add your login logic here
            alert(`Logging in with email: ${this.email} and password: ${this.password}`);
        }
    }
}
</script>