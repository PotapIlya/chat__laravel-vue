<template>
	<div class="d-flex flex-column">
		
		<form @submit.prevent="save" class="d-flex align-items-center">
			<input v-model="input" class="w-75">
			<button type="submit" class="w-25 btn btn-success">Save</button>
		</form>
		
		<ul
			v-if="arrayMessage.length"
			class="my-3 list-inline">
			
			<li v-for="item in arrayMessage">
				<span class="d-block h4">{{ item.message }}</span>
				<hr>
			</li>
		
		</ul>
	</div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "ChatComponent",
		props: ['chat'],
		data: () => ({
			arrayMessage: [],
            input: null,
			url: '/message',
		}),
        mounted() {
            this.arrayMessage = this.chat
			
            const socket = io(':6001');
            
            socket.on('laravel_database_chat:message',  (data) => {
                console.log(data)
            })
			
        },
		created() {
        //     listenForBroadcast(survey_id) {
        //         Echo.join('survey.' + survey_id)
        //             .here((users) => {
        //                 this.users_viewing = users;
        //                 this.$forceUpdate();
        //             })
        //             .joining((user) => {
        //                 if (this.checkIfUserAlreadyViewingSurvey(user)) {
        //                     this.users_viewing.push(user);
        //                     this.$forceUpdate();
        //                 }
        //             })
        //             .leaving((user) => {
        //                 this.removeViewingUser(user);
        //                 this.$forceUpdate();
        //             });
        //     },
        // },
        methods: {
            save()
			{
			    if (this.input !== '' && this.input !== null)
				{
				    axios.post(this.url, {
				        data: this.input,
					})
					.then(response =>
					{
					    if (response.data.success)
						{
						    this.arrayMessage.push(response.data.success);
							this.input = null;
						}
					    if (response.data.error)
						{
						    alert(response.data.error)
						}
					})
					.catch(error => {
                        console.log(error)
					})
				}
			}
		},
    }
</script>
