<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="$emit('close')"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myRegister">
		<div class="login_icon"><i class="icon_lock_alt"></i></div>
		<input type="text" class="form-control form-white" placeholder="Name">
		<input type="text" class="form-control form-white" placeholder="Last Name">
		<input type="email" class="form-control form-white" placeholder="Email">
		<input type="text" class="form-control form-white" placeholder="Password"  id="password1">
		<input type="text" class="form-control form-white" placeholder="Confirm password"  id="password2">
		<div id="pass-info" class="clearfix"></div>
		<div class="checkbox-holder text-left">
			<div class="checkbox">
				<input type="checkbox" value="accept_2" id="check_2" name="check_2" />
				<label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
			</div>
		</div>
		<button class="btn btn-submit">Register</button>
	</div>
</div>
</template>

<script>
export default {

}
</script>