<template>
	<div class="min-h-screen bg-gray-100 p-8">
		<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
			<div class="flex justify-between items-center mb-6">
				<h2 class="text-3xl font-bold text-[#cf2e2e]">Categories</h2>
				<div class="flex items-center">
					<input type="text" v-model="searchQuery" placeholder="Filter categories..." class="w-48 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]">
					<button @click="addCategory" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Add Category</button>
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
					<tr v-for="category in filteredCategories" :key="category.id">
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ category.id }}</td>
						<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ category.name }}</td>
						<td class="py-2 px-4 border-b border-gray-300 flex justify-end space-x-2">
							<button @click="editCategory(category.id)" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out">Edit</button>
							<button @click="deleteCategory(category.id)" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Delete</button>
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
		
		name: "Categories",
		data() {
			return {
				searchQuery: '',
				categories: [],
			};
		},
		computed: {
			filteredCategories() {
				return this.categories.filter(category =>
					category.name.toLowerCase().includes(this.searchQuery.toLowerCase())
				);
			},
		},
		mounted() {
			this.getAllCategories();
		},
		methods: {
			addCategory() {
				this.$router.push(`/categories/add`);
			},
			async getAllCategories() {
				try {
					const response = await fetch('/api/category');
					if (response.ok) {
						const data = await response.json();
						this.categories = data;
					}
					throw new Error('Unable to pull categories');
					
				} catch (error) {
					console.error('Unable to pull categories:', error);
				}
			},
			editCategory(id) {
				this.$router.push(`/categories/${id}/edit`);
			},
			async deleteCategory(id) {
				try {
                    const response = await fetch(`/api/category/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }});

                    if (!response.ok) {
                        throw new Error('Unable to delete category');
                    }
                    
                    this.getAllCategories();
                } catch (error) {
                    console.error('There was an error deleteing a category!', error);
                }
			}
		}
	};
</script>