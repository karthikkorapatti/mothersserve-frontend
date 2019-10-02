<template>
<div class="col-md-3" id="sidebar">
	<div class="theiaStickySidebar">
		<div id="cart_box" >
			<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
			<table class="table table_summary">
				<tbody>
					<tr v-for="item in getCartItems">
						<td>
							<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>{{ item.quantity }}x</strong> {{ item.entry.name }}
						</td>
						<td>
							<strong class="pull-right">{{ `${item.entry.currency} ${item.quantity * item.entry.price}` }}</strong>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<div class="row" id="options_2">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
					<label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
					<label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
				</div>
			</div><!-- Edn options 2 -->
			<hr>
			<table class="table table_summary">
				<tbody>
					<tr>
						<td>
							 Subtotal <span class="pull-right">Rs {{ getSubTotal }}</span>
						</td>
					</tr>
					<!-- <tr>
						<td>
							 Delivery fee <span class="pull-right">$10</span>
						</td>
					</tr> -->
					<tr>
						<td class="total">
							 TOTAL <span class="pull-right">Rs {{ getTotal }}</span>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<portal-target name="destination"></portal-target>
		</div><!-- End cart_box -->
	</div><!-- End theiaStickySidebar -->
</div><!-- End col-md-3 -->
</template>

<script type="text/javascript">
export default {
	data() {
		return {

		}
	},

	computed: {
		getCartItems() {
			return this.$store.getters['cart/getItems'];
		},

		getSubTotal(state) {
			if(! this.getCartItems.length) {
				return 0;
			}

			let total = 0;

			this.getCartItems.forEach((item) => {
				total += (item.entry.price * item.quantity);
			});

			return total;
		},

		getDeliveryFee() {
			return this.$store.getters['cart/getDeliveryFee'];
		},

		getTotal() {
			return this.getSubTotal + this.getDeliveryFee;
		}
	},

	methods: {

	}
}
</script>