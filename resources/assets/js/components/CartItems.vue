<template>
<div class="col-md-3" id="sidebar">
	<div class="theiaStickySidebar">
		<div id="cart_box" >
			<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
			<table class="table table_summary">
				<tbody>
					<tr v-for="item in getCartItems">
						<td>
							<a href="javascript:void(0);" class="remove_item" @click="removeFromCart(item)">
								<i class="icon_minus_alt"></i>
							</a>
							<strong>{{ item.quantity }}x</strong> {{ item.entry.name }}
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
					<label><input type="radio" value="1" :checked="getDeliveryOption == 1" name="option_2" class="icheck" @click="changeDeliveryOption(1)">Delivery</label>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
					<label><input type="radio" value="0" :checked="getDeliveryOption == 0" name="option_2" class="icheck" @click="changeDeliveryOption(0)">Pick Up</label>
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
					<tr>
						<td>
							 Delivery fee <span class="pull-right">Rs {{ getDeliveryFee }}</span>
						</td>
					</tr>
					<tr>
						<td>
							Tax <span class="pull-right">{{ getTax }}%</span>
						</td>
					</tr>
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
		return {}
	},

	computed: {
		getCartItems() {
			return this.$store.getters['cart/getItems'];
		},

		getSubTotal(state) {
			return this.$store.getters['cart/getSubTotal'];
		},

		getDeliveryFee() {
			return this.$store.getters['cart/getDeliveryFee'];
		},

		getTax() {
			return this.$store.getters['cart/getTax'];
		},

		getTotal() {
			return Math.floor(this.getSubTotal + this.getDeliveryFee + ((this.getSubTotal * this.getTax) / 100));
		},

		getDeliveryOption() {
			return this.$store.getters['cart/getDeliveryOption'];
		},

		getCartRestaurant() {
			return this.$store.getters['cart/getRestaurant'];
		}
	},

	methods: {
		removeFromCart(item) {
			this.$store.commit('cart/REMOVE_FROM_CART', item);
		},

		changeDeliveryOption(value) {
			this.$store.commit('cart/CHANGE_DELIVERY_OPTION', value);
		}
	}
}
</script>