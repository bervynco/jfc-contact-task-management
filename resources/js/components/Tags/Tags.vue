<template>
	<div class="min-h-screen bg-gray-100 p-8">
		<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-3xl font-bold text-[#cf2e2e]">Tags</h2>
				<div class="flex items-center">
					<input type="text" v-model="searchQuery" placeholder="Filter tag..." class="w-48 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]">
					<button @click="addTag" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Add Tag</button>
				</div>
			</div>
			<div class="overflow-x-auto">
				<table class="min-w-full bg-white">
				<thead>
					<tr>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">ID</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Name</th>
						<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600"></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="tag in filteredTags" :key="tag.id">
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ tag.id }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ tag.name }}</td>
						<td class="py-2 px-4 border-b border-gray-300 flex justify-end space-x-2">
							<button @click="editTag(tag.id)" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out">Edit</button>
							<button @click="deleteTag(tag.id)" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Delete</button>
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
		name: "Tags",
		data() {
			return {
				searchQuery: '',
				tags: [],
			};
		},
		computed: {
			filteredTags() {
				return this.tags.filter(tag =>
					tag.name.toLowerCase().includes(this.searchQuery.toLowerCase())
				);
			},
		},
		mounted() {
			this.getAllTags();
		},
		methods: {
			addTag() {
				this.$router.push(`/tags/add`);
			},
			async getAllTags() {
				try {
					this.tags = await fetchWithBearerToken('/api/tag', "GET", {}, {});
				} catch (error) {
					console.error('Unable to pull tags:', error);
				}
			},
			editTag(id) {
				this.$router.push(`/tags/${id}/edit`);
			},
			async deleteTag(id) {
				try {
					await fetchWithBearerToken(`/api/tag/${id}`, "DELETE", {}, {});                    
                    this.getAllTags();
                } catch (error) {
                    console.error('There was an error deleteing a tag!', error);
                }
			}

		}
	};
</script>