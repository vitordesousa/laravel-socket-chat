<template>
    <app-layout title="Chat">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex" style="height: 40rem">
						<div class="users-list w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-auto">
							<ul>
								<li
									v-for="conversation in conversations" :key="conversation.id"
									@click="loadMessages(conversation.id , conversation.customer.id)"
									:class="userActive && userActive != '' && userActive == conversation.customer.id ? 'bg-gray-200 bg-opacity-50': ''"
									class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
										<p class="flex items-center">
											{{conversation.customer.name}}
											<span class="ml-2 w-2 h-2 bg-blue-400 rounded-full"></span>
										</p>
								</li>
							</ul>
						</div>
						<div class="conversation w-9/12 flex flex-col justify-between">
							<div class="w-full p-6 flex flex-col  overflow-y-auto">
								<div 
									v-for="message in messages" :key="message.id"
									:class="(message.user_id == $page.props.auth.user.id) ? 'text-right' : ''"
									class="w-full mb-3 message">
										<p :class="(message.user_id == $page.props.auth.user.id) ? 'messageFromMe' : 'messageToMe'" class="inline-block p-2 rounded-md max-w-7xl">
											{{message.message}}
										</p>
										<span class="block mt-1 text-xs text-gray-500 message-time">{{message.created_at_formated}}</span>
								</div>								
							</div>

							<div class="form w-full bg-gray-100 p-6 border-t border-gray-200 " v-show="userActive != ''">
								<form v-on:submit.prevent="sendMessage">
									<div class="rounded-md flex overflow-hidden border-gray-300">
										<input v-model="message" type="text" name="message" class="flex-1 px-4 py-2 text-sm focus:outiline-none">
										<button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 disabled:cursor-not-allowed" type="submit" :disabled="this.message == ''">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
        },
		data(){
			return {
				conversations : [],
				messages : [],
				conversation: '',
				userActive : '',
				message : ''
			}
		},
		methods: {
			scrollToBottom(){
				if(this.messages.length > 0){
					document.querySelectorAll('.message:last-child')[0].scrollIntoView()
				}
			},
			async loadMessages(conversationId, userId){
				await axios.get(`/api/admin/messages/${conversationId}/${userId}`).then(response => {
					this.messages = response.data.messages
					this.userActive = userId
					this.conversation = conversationId
				})

				this.scrollToBottom()
			},

			async sendMessage(e){
				e.preventDefault();
				
				await axios.post('/api/admin/messages', {
					'message' 			:	this.message,
					'conversation_id'	:	this.conversation
				}).then(response => {
					this.messages.push(response.data.message)
					this.message = ''
				})

				this.scrollToBottom()
			},
		},
		mounted(){

			axios.get('/api/admin/conversations').then(response => {
				this.conversations = response.data.conversations
			})

			Echo.private(`user.${this.$page.props.auth.user.id}` ).listen('.SendMessage', async (e) => {

				if(this.userActive && this.userActive == e.message.user_id){
					await this.messages.push(e.message)
					this.scrollToBottom()
				} else {

				}
			})
		}
    })
</script>