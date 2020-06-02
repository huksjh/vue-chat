<template>
	<div class="flex items-center">
		<div class="border w-4/5 md:w-1/2 mx-auto mb-40">
			<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
				<div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">Chat {{ currentUser }}</div>

				<div class="w-full">
					<div class="flex h-full">
						<div class="w-2/5 border border-t-0 border-l-0 border-b-0 h-auto">
							<ChatUserList :current-user="currentUser" @getUserId="getUserId" />
						</div>

						<div v-if="clickUser" class="p-5 w-full h-full">
							<h1 class="pb-4 font-extrabold text-orange-900">선택한 회원 {{ clickName }}</h1>

							<ChatArea :current-user="currentUser" :click-user="clickUser" :res-message="chatMessages" />
							<textarea
								id="msgTextarea"
								v-model="changeMessage"
								@keydown.enter="handleEnter"
								class="rounded border border-purple-500 w-full p-3 h-16 resize-none leading-relaxed"
							></textarea>
						</div>

						<div v-else class="p-5 w-full h-full">
							<h1 class="pb-4 font-extrabold text-orange-900">대화할 회원을 선택하세요</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import ChatUserList from "./ChatUserList";
	import ChatArea from "./ChatArea";

	export default {
		props: {
			currentUser: {
				type: Number,
				required: true
			}
		},

		data() {
			return {
				clickUser: null,
				clickName: null,
				changeMessage: "",
				chatMessages: []
			};
		},
		components: {
			ChatUserList,
			ChatArea
		},

		created() {
			window.Echo.private("chats").listen("ChatMessageSent", e => {
				/* console.log('받는id',e.message.to); */
				/* console.log('현재id',this.currentUser); */
				/* console.log('보내는id',e.message.from); */
				/* console.log('선택id', this.clickUser); */
				//자기 자신한테는 안보내도됨
				if (
					e.message.to === this.currentUser &&
					e.message.from.id === this.clickUser
				) {
                    //console.log("window.Echo", e);
					this.chatMessages.push(e.message);
				}
			});
		},

		methods: {
			//chatUserList 에서  this.@emit('getUserId','') 으로 넘어와서  받을때 @getUserId="getUserId" 으로 받음
			getUserId(value) {
				//console.log("getUser", value);
				this.clickUser = value.userId;
				this.clickName = value.userName;
				this.getMessages();
			},

			//회원간 대화 내용 불러오기
			getMessages() {
				axios
					.get("/api/messages", {
						params: {
							to: this.clickUser,
							from: this.currentUser
						}
					})
					.then(res => {
						//console.log(res);
						this.chatMessages = res.data.messages;
					})
					.catch(error => {
						console.log(error);
					});
			},

			handleEnter(e) {
				if (e.ctrlKey) {
					return this.newLine();
				}
				e.preventDefault();
				//console.log('handleEnter');

				if (this.changeMessage) {
					axios
						.post("/api/messages", {
							content: this.changeMessage,
							to: this.clickUser,
							from: this.currentUser
						})
						.then(res => {
							//console.log(res.data);
							this.chatMessages.push(res.data.messages);
						})
						.catch(error => {
							console.log(error);
						});
				}
				this.changeMessage = "";
			},
			newLine() {
				let msgTextarea = document.querySelector("#msgTextarea");
				//console.log('newline', msgTextarea.value);
				msgTextarea.value += "\n";
				msgTextarea.scrollTop = msgTextarea.scrollHeight;
			}
		},

		mounted() {
			//console.log("Component mounted.");
		}
	};
</script>
