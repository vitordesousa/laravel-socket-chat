<template>
    <app-layout title="Chat User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex" style="height: 40rem">
						<div class="conversation w-full flex flex-col justify-between">
							<div class="title">
								<h1 class="text-xl p-6">{{headerMessage}}</h1>
							</div>
							<div class="w-full p-6 flex flex-col h-full overflow-y-auto">
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

							<div class="form w-full bg-gray-100 p-6 border-t border-gray-200 ">
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
				headerMessage : 'Aguardando um usuário se conectar ...',
				messages : [],
				conversation: '',
				message : ''
			}
		},
		methods: {
			scrollToBottom(){
				if(this.messages.length > 0){
					document.querySelectorAll('.message:last-child')[0].scrollIntoView()
				}
			},
			
			async sendMessage(e){
				e.preventDefault();
				
				await axios.post('/api/panel/messages', {
					'message' 			:	this.message
				}).then(response => {
					this.messages.push(response.data.message)
					this.message = ''
				})

				this.scrollToBottom()
			},
		},
		async mounted(){
			await axios.get(`/api/panel/messages`).then(response => {
				this.messages = response.data.messages
				this.headerMessage = `Conversa com "${this.messages[0].conversation.emplooyer.name}"`
			})

			this.scrollToBottom()

			Echo.private(`user.${this.$page.props.auth.user.id}` ).listen('.SendMessage', async(e) => {
				await this.messages.push(e.message)
				this.scrollToBottom()
			})

		}
    })
</script>