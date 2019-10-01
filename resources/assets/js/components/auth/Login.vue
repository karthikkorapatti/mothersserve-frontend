<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="$emit('close')"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myLogin">
		<div class="login_icon"><i class="icon_lock_alt"></i></div>
		<input type="text" class="form-control form-white" placeholder="Username">
		<input type="text" class="form-control form-white" placeholder="Password">
		<!-- <div class="text-left">
			<a href="#">Forgot Password?</a>
		</div> -->
		<button class="btn btn-submit">Submit</button>
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
			}
		}
	}
}
</script>