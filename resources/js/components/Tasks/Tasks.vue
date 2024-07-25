<template>
	<div class="min-h-screen bg-gray-100 p-8">
		<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
			<!-- Top Table Section -->
			<div class="mb-8">
				<div class="flex justify-between items-center mb-4">
					<h2 class="text-3xl font-bold text-[#cf2e2e]">Open Tasks</h2>
					<div class="flex items-center">
						<input type="text" v-model="searchQuery" placeholder="Filter task..." class="w-48 mr-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-[#cf2e2e]">
						<button @click="addTask" class="bg-[#cf2e2e] text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 transition duration-150 ease-in-out">Add Task</button>
					</div>
				</div>
				<div class="overflow-x-auto">
					<table class="min-w-full bg-white">
					<thead>
						<tr>
							<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">ID</th>
							<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">For</th>
							<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Status</th>
							<th class="py-2 px-4 border-b-2 border-gray-300 text-left text-sm text-gray-600">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="task in filteredTasks" :key="task.id">
							<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ task.id }}</td>
							<td class="py-2 px-4 border-b border-gray-300 text-sm">{{ task.name }}</td>
							<td class="py-2 px-4 border-b border-gray-300 text-sm">
								<span v-if="task.status === 0">Complete</span>
								<span v-if="task.status === 1">Open</span>
							</td>
							<td class="py-2 px-4 border-b border-gray-300 text-sm">
								 <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 cursor-pointer"  v-if="task.status === 1" @click="updateStatus(0, task.id)">
									Complete
								</span>
								<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 cursor-pointer" v-if="task.status === 0" @click="updateStatus(1, task.id)">
									Re-Open
								</span>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import { fetchWithBearerToken } from '../fetchWithBearerToken';
	export default {
		name: "Tasks",
		data() {
			return {
				searchQuery: '',
				tasks: [],
			};
		},
		computed: {
			filteredTasks() {
				return this.tasks.filter(task =>
					task.name.toLowerCase().includes(this.searchQuery.toLowerCase())
				);
			},
		},
		methods: {
			addTask() {
				this.$router.push('/tasks/add');
			},
			async getAllTasks() {
				try {
					const response = await fetchWithBearerToken('/api/tasks', "GET", {}, {});
					this.tasks = response.data;
					
				} catch (error) {
					console.error('Unable to pull tasks:', error);
				}
			},
			async updateStatus(status, id) {
				let payload = {
					'status': status
				}
				try {
                    await fetchWithBearerToken(`/api/tasks/${id}`, "PUT", payload, {});
                    this.getAllTasks();
                } catch (error) {
                    console.error('There was an error changing status!', error);
                }
			}
		},
		mounted() {
			this.getAllTasks();
		}
	};
</script>