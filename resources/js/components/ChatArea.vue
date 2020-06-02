<template>
	<div class="border overflow-y-auto h-auto mb-4 px-2" style="max-height:500px;"  v-chat-scroll="{scrollonremoved:true}" >
		<ChatMessage
			v-for="message in resMessage"
			:key="message.id"
			:current-user="currentUser"
			:message="message"
			
		/>
	</div>
</template>

<script>
	import ChatMessage from "./ChatMessage";

	export default {
		components: {
			ChatMessage
		},
		props: {
			currentUser: {
				type: Number,
				required: true
			},
			clickUser: {
				type: Number,
				required: true
			},
			resMessage: {
				type: Array,
				required: false
			}
		},

		computed: {},
		created() {},

		methods: {},
		mounted() {
			//console.log("Component mounted.");
		}
	};
</script>
