<template>
	<div class="p-5 h-full">
		<h1 class="pb-5 font-black">회원리스트</h1>

		<ul class="border border-b-0">
			<li
				v-for="user in this.userListReturn"
				:key="user.id"
				class="p-2 border border-t-0 border-l-0 border-r-0 hover:bg-gray-300 cursor-pointer"
				@click="getUserId(user.id, user.name)"
			>{{ user.name }}</li>
		</ul>
	</div>
</template>

<script>
	export default {
		props: {
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
		computed: {
			userListReturn() {
				return this.userList.filter(user => {
					return this.currentUser !== user.id;
				});
			}
		},
		created() {
			axios
				.get("/api/users")
				.then(res => {
					//console.log(res);
					this.userList = res.data.users;
				})
				.catch(error => {
					console.log("error", error);
				});
		},

		methods: {
			getUserId(userId, userName) {
				//console.log(userId);
				const user = { userId: userId, userName: userName };
				//console.log(user);
				this.$emit("getUserId", user);
			}
		},
		mounted() {
			//console.log("Component mounted.");
		}
	};
</script>
