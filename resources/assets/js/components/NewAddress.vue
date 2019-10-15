<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="close()"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myLogin">
		<input type="text" class="form-control form-white" placeholder="Apartment" v-model="form.apartment">
		<input type="text" class="form-control form-white" placeholder="Street" v-model="form.street">
		<label>Right now Only available in Rajarajeshwari Nagar</label>
		<button class="btn btn-submit" @click="store()">Save</button>

		<ul>
			<li v-for="error in errors" v-text="error[0]"></li>
		</ul>
	</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			form: {},
			errors: {}
		}
	},

	methods: {
		close() {
			this.$modal.hide('modal:addresses:create');
		},

		store() {
			this.errors = {};

			axios.post(`${this.$root.urls.api}/addresses`, this.form)
 			.then(({data}) => {
 				console.log(data);

 				window.events.$emit('addresses:created', true);

 				this.close();
 			})
 			.catch(error => {
 				console.log(error.response);

 				if(error.response.status === 422) {
 					this.errors = error.response.data;
 				}
 			});
		}
	}
}
</script>