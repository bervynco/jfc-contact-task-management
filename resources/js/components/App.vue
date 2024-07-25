<template>
	<div id="app" >
	  	<Header v-if="isAuthenticated"></Header>
		<router-view></router-view>
	</div>
</template>
  
  

<script>
import Header from './Header.vue';
import { mapState } from 'vuex';
export default {
	name: 'App',
	components: {
		Header
	},
	setup() {
	},
	computed: {
		...mapState(['isAuthenticated'])
	}
}
</script>

<style scoped>
</style>