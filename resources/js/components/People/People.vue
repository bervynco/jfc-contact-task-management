<template>
	<div class="min-h-screen bg-gray-100 p-8">
		<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-3xl font-bold text-[#cf2e2e]">People</h2>
				<div class="flex items-center">
					<input type="text" v-model="searchQuery" placeholder="Filter people..." class="w-48 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]">
					<button @click="addPeople" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Add People</button>
				</div>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full bg-white">
				<thead>
					<tr>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">ID</th>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Name</th>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Email</th>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Phone</th>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Business</th>
					<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="people in filteredPeople" :key="people.id">
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ people.id }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ people.firstname }} {{ people.lastname }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ people.email }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ people.phone }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ people.business.name }}</td>
						<td class="py-2 px-4 border-b border-gray-300 flex justify-end space-x-2">
							<button @click="editPeople(people.id)" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out">Edit</button>
							<button @click="deletePeople(people.id)" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Delete</button>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: "People",
		data() {
			return {
				searchQuery: '',
				people: [],
			};
		},
		computed: {
			filteredPeople() {
				return this.people.filter(people =>
					people.firstname.toLowerCase().includes(this.searchQuery.toLowerCase()) || people.lastname.toLowerCase().includes(this.searchQuery.toLowerCase())
				);
			},
		},
		methods: {
			addPeople() {
				this.$router.push('/people/add');
			},
			async getAllPeople() {
				try {
					const response = await fetch('/api/people');
					if (!response.ok) {
						throw new Error('Unable to pull people');
					}
					const data = await response.json();
					this.people = data.data;
					console.log(data);
					
				} catch (error) {
					console.error('Unable to pull people:', error);
				}
			},
			async deletePeople(id) {
				try {
					const response = await fetch(`/api/people/${id}`, {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json',
					}});

					if (!response.ok) {
						throw new Error('Unable to delete people');
					}
					
					this.getAllPeople();
				} catch (error) {
					console.error('There was an error deleting a people!', error);
				}
			},
			editPeople(id) {
				this.$router.push(`/people/${id}/edit`);
			}
		},
		mounted() {
			this.getAllPeople();
		}
	};
</script>