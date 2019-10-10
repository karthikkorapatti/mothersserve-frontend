<template>
<div class="modal-content modal-popup">
	<a href="javascript:void(0);" class="close-link" @click="$emit('close')"><i class="icon_close_alt2"></i></a>
	<div class="popup-form" id="myLogin">
		<div>Do you want to Change the Restaurant?</div>
		<button class="btn btn-submit" @click="discard()">Change</button>
	</div>
</div>
</template>

<script>
export default {
	props: {
		initCart: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
		}
	},

	methods: {
		discard() {
			this.$store.commit('cart/EMPTY_CART');

			this.$store.commit('cart/ADD_TO_CART', this.initCart);

			this.$modal.hide('modal:cart:clear');
		}
	}
}
</script>