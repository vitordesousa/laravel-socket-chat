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
									class="w-full mb-3 text-right">
										<p class="inline-block p-2 rounded-md max-w-7xl messageFromMe">
											{{message.message}}
										</p>
										<span class="block mt-1 text-xs text-gray-500 message-time">{{message.created_at}}</span>
								</div>
								
							</div>

							<div class="form w-full bg-gray-100 p-6 border-t border-gray-200 ">
								<form class="">
									<div class="rounded-md flex overflow-hidden border-gray-300">
										<input type="text" name="message" class="flex-1 px-4 py-2 text-sm focus:outiline-none">
										<button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2" type="submit">Enviar</button>
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
			}
		},
		methods: {
			loadMessages: function (conversationId, userId){
				axios.get(`/api/messages/${conversationId}/${userId}`).then(response => {
					this.messages = response.data.messages
				})
			}
		},
		mounted(){
			axios.get('/api/users').then(response => {
				this.conversations = response.data.conversations
			})
		}
    })
</script>
<style>
</style>