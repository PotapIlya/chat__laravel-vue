<template>
	<div class="d-flex">
		
		<div class="col">
			<form @submit.prevent="save" class="d-flex align-items-center">
				<input
						v-model="input"
						class="w-75"
						@keyup.enter="save"
						@keydown="actionUser"
				>
				<button type="submit" class="w-25 btn btn-success">Save</button>
			</form>
			<span v-if="isActive">
				123
			</span>
			
			<ul
					v-if="arrayMessage.length"
					class="my-3 list-inline"
			>
				
				<li v-for="item in arrayMessage">
					<span class="d-block h4">{{ item.message }}</span>
					<hr>
				</li>
			
			</ul>
		</div>
		
		<ul>
			<li v-for="user in activeUser">
				{{ user }}
			</li>
		</ul>
		
	</div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "PrivateChatComponent",
		props: [
		    'room',
			'id',
			'user'
		],
		data: () => ({
            arrayMessage: [],
            input: null,
            url: '/message',
            isActive: false,
			activeUser: [],
		}),
		computed: {
  			channel()
			{
			   return window.Echo.channel('laravel_database_presence-room.'+this.id)
			}
		},
		mounted() {
            // console.log(this.room);
			
            // window.Echo.private() //
			this.channel
				.here(user =>{
				    this.activeUser = user;
				})
				.joining(user =>{
				    this.activeUser.push(user)
				})
				.leaving(user =>{
                    this.activeUser.splice(this.activeUser.indexOf(user), 1)
				})
                .listen('NewMessage', ({message}) => {
                    this.arrayMessage.push({ message: message.data});
                    this.isActive = false;
                })
				.listenForWhisper('typing', (e) =>{
				    this.isActive = e;
				    
				    setTimeout(() =>{
					    this.isActive = false;
					}, 2000);
				})


        },
		methods:{
            actionUser()
			{
                // console.log('error')
			    // this.channel.whisper('typing', {
				// 	    name: this.user.name
				// 	})
			},
            save()
            {
                if (this.input !== '' && this.input !== null)
                {
                    axios.post(this.url, {
                        data: this.input,
                        id: this.id,
                    })
					.then(response =>{
						if (response)
						{
							// console.log(response.data, 'response')
							this.input = null;
						}
					})
                }
            }
		}
    }
</script>
