<template>
	
	<div class="block w-auto clear-both">
		<div class="w-3/5 border  rounded rounded-lg bg-gray-600  my-6 p-5" 
		:class="{ 'float-right bg-pink-600 ' : message.from.id === currentUser }"
		>
			<div class="pt-2 text-white font-extrabold">{{ message.from.name }} {{ message.created_at }}</div>
			<div class="py-2 text-white" v-html="message.content.split('\n').join('<br />')"></div>
		</div>
	</div>		
</template>

<script>
	export default {
		props: {
			message: {
				type: Object,
				required: false
			},
			currentUser: {
				type: Number,
				required: true
			}

		},
		data() {
			return {
				userList: []
			};
		},
		mounted() {
			//console.log("Component mounted.");
		}
	};
</script>
