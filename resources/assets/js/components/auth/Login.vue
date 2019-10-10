<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="$emit('close')"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myLogin">
		<div class="login_icon"><i class="icon_lock_alt"></i></div>
		<input type="text" class="form-control form-white" placeholder="Username" v-model="form.username">
		<input type="password" class="form-control form-white" placeholder="Password" v-model="form.password">
		<div class="test-left">
			<div v-for="error in errors" v-text="error"></div>
		</div>
		<!-- <div class="text-left">
			<a href="#">Forgot Password?</a>
		</div> -->
		<button class="btn btn-submit" @click="submit()">Submit</button>
		<div class="text-left">
			Dont have account? <a href="javascript:void(0);" @click="register()">Click here</a>
		</div>
	</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			form: {
				username: '',
				password: ''
			},
			errors: []
		}
	},

	methods: {
		submit() {
			this.errors = [];

			if(!this.form.username || !this.form.password) {
				this.errors.push("Username/Password is required.");

				return;
			}

			axios.post(`${this.$root.urls.api}/login`, this.form)
 			.then(({data}) => {
 				console.log(data);

 				this.$store.commit('auth/INITIALIZE', { user: data.data });
 				this.$store.commit('auth/LOGIN_SUCCESSFUL', { isLoggedIn: true });

 				this.$modal.hide('modal:users:login');

 				// this.restaurants = data.data;

 				// this.loaded = true;
 			})
 			.catch(error => {
 				console.log(error.response);

 				this.errors.push(error.response.data.data);
 			});
		},

		register() {
			window.events.$emit('register:requested', true);
			this.$modal.hide('modal:users:login');
		}
	}
}
</script>