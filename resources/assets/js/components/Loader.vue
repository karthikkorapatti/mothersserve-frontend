<template>
<div class="modal-content modal-popup">
	<h3>Please Wait...!!!</h3>
</div>
</template>

<script>
export default {
	data() {
		return {
		}
	},

	methods: {
		close() {
			this.$modal.hide('modal:loader');
		}
	}
}
</script>