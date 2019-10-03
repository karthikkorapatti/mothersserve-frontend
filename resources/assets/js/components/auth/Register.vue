<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="$emit('close')"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myRegister">
		<div class="login_icon"><i class="icon_lock_alt"></i></div>
		<input type="text" class="form-control form-white" placeholder="First Name" v-model="form.first_name">
		<input type="text" class="form-control form-white" placeholder="Last Name" v-model="form.last_name">
		<input type="email" class="form-control form-white" placeholder="Email" v-model="form.email">
		<input type="password" class="form-control form-white" placeholder="Password" id="password1" v-model="form.password">
		<input type="text" class="form-control form-white" placeholder="Phone Number" v-model="form.phone">
		<div id="pass-info" class="clearfix"></div>
		<div class="checkbox-holder text-left">
			<div class="checkbox">
				<input type="checkbox" value="1" id="check_2" name="check_2" v-model="form.agreement" true-value="1" false-value="0"/>
				<label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
			</div>
		</div>
		<button class="btn btn-submit" @click="register()">Register</button>
	</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			form: {
				email: '',
				password: '',
				first_name: '',
				last_name: '',
				phone: '',
				agreement: ''
			}
		}
	},

	methods: {
		register() {
			this.errors = [];

			axios.post(`${this.$root.urls.api}/register`, this.form)
 			.then(({data}) => {
 				console.log(data);

 				this.$store.commit('auth/INITIALIZE', { user: data.data });
 				this.$store.commit('auth/LOGIN_SUCCESSFUL', { isLoggedIn: true });

 				this.$modal.hide('modal:users:register');
 			})
 			.catch(error => {
 				console.log(error.response);

 				this.errors.push(error.response.data.data);
 			});
		}
	}
}
</script>