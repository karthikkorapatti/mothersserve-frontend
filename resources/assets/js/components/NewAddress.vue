<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="close()"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myLogin">
		<input type="text" class="form-control form-white" placeholder="Apartment" v-model="form.first_name">
		<input type="text" class="form-control form-white" placeholder="Street" v-model="form.last_name">
		<input type="text" class="form-control form-white" placeholder="City" v-model="form.email">
		<input type="text" class="form-control form-white" placeholder="State" v-model="form.email">
		<input type="text" class="form-control form-white" placeholder="Country" v-model="form.email">
		<button class="btn btn-submit" @click="store()">Save</button>
	</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			form: {}
		}
	},

	methods: {
		close() {
			this.$modal.hide('modal:addresses:create');
		},

		store() {

		}
	}
}
</script>