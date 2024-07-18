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
            </tr>
          </thead>
          <tbody>
            <tr v-for="business in filteredBusinesses" :key="business.id">
              <td class="py-2 px-4 border-b border-gray-300 text-sm">{{ business.id }}</td>
              <td class="py-2 px-4 border-b border-gray-300 text-sm">{{ business.name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
	data() {
		return {
		searchQuery: '',
		businesses: [
			{ id: 1, name: 'Business 1' },
			{ id: 2, name: 'Business 2' },
			{ id: 3, name: 'Business 3' },
			// Add more businesses as needed
		],
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
			// Add your logic to handle adding a new business here
			alert('Add Business button clicked');
		},
	},
};
</script>