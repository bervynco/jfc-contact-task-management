<template>
	<div class="min-h-screen bg-gray-100 p-8">
		<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-3xl font-bold text-[#cf2e2e]">Businesses</h2>
				<div class="flex items-center">
				<input type="text" v-model="searchQuery" placeholder="Filter businesses..." class="w-48 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]">
				<button @click="addBusiness" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Add Business</button>
				</div>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full bg-white">
				<thead>
					<tr>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">ID</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Name</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Contact Email</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Tags</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Categories</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="business in filteredBusinesses" :key="business.id">
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ business.id }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ business.name }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ business.email }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm"></td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm"></td>
						<td class="py-2 px-4 border-b border-gray-300 flex justify-end space-x-2">
							<button @click="editBusiness(business.id)" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out">Edit</button>
							<button @click="deleteBusiness(business.id)" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Delete</button>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<script>
import { fetchWithBearerToken } from '../fetchWithBearerToken';
export default {
	data() {
		return {
		searchQuery: '',
		businesses: [],
		};
	},
	computed: {
		filteredBusinesses() {
			return this.businesses.filter(business =>
				business.name.toLowerCase().includes(this.searchQuery.toLowerCase())
			);
		},
	},
	methods: {
		addBusiness() {
			this.$router.push('/business/add');
		},
		editBusiness(id) {
			this.$router.push(`/business/${id}/edit`);
		},
		async getAllBusinesses() {
			try {
				const response = await fetchWithBearerToken('/api/business', "GET");
				this.businesses = response.data;
				
			} catch (error) {
				console.error('Unable to pull business:', error);
			}
		},
		async deleteBusiness(id) {
			try {
				const response = await fetch(`/api/business/${id}`, {
				method: 'DELETE',
				headers: {
					'Content-Type': 'application/json',
					'Accept': 'application/json',
				}});

				if (!response.ok) {
					throw new Error('Unable to delete business');
				}
				
				this.getAllBusinesses();
			} catch (error) {
				console.error('There was an error deleting a business!', error);
			}
		}

	},
	mounted() {
		this.getAllBusinesses();
	}
};
</script>