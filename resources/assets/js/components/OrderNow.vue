<template>
<div>
	<div class="col-md-6">
		<div class="box_style_2" id="order_process">
			<h2 class="inner">Addressess</h2>
			<div>Select Address below:</div>
			<div class="form-group payment_select" v-for="address in addresses">
				<label><input type="radio"
					name="payment_method"
					:checked="(getDeliveryAddress && getDeliveryAddress.id) == address.Address.id"
					class="icheck"
					@click="selectDeliveryAddress(address.Address)">{{ formatAddress(address.Address) }}</label>
			</div>
		</div><!-- End box_style_1 -->
	</div><!-- End col-md-6 -->

	<cart-items></cart-items>

	<portal	to="topBanner">
		<div id="subheader">
			<div id="sub_content">
				<h1>Place your order</h1>
				<div class="bs-wizard">
					<div class="col-xs-4 bs-wizard-step active">
					  <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
					  <div class="progress"><div class="progress-bar"></div></div>
					  <a href="#0" class="bs-wizard-dot"></a>
					</div>
								   
					<div class="col-xs-4 bs-wizard-step disabled">
					  <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
					  <div class="progress"><div class="progress-bar"></div></div>		                  
					  <router-link to="/Checkout" class="bs-wizard-dot"></router-link>
					</div>
				
					<div class="col-xs-4 bs-wizard-step disabled">
						<div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
						<div class="progress"><div class="progress-bar"></div></div>		                  
						<router-link to="/ConfirmOrder" class="bs-wizard-dot"></router-link>
					</div>  
				</div><!-- End bs-wizard --> 
			</div><!-- End sub_content -->
		</div><!-- End subheader -->
	</portal>

	<portal to="destination">
		<a href="javascript:void(0);" class="btn_full" @click="goToCheckOut();">GO TO CHECKOUT</a>
		<span v-if="openingShortly">Please Select Delivery Address</span>
		<a @click="$router.go(-1)" class="btn_full"><i class="icon-right"></i>&nbsp;ADD OTHER ITEM</a>
	</portal>

	<portal	to="sideBarLeft">
		<div class="box_style_2 hidden-xs info">
			<h4 class="nomargin_top">Delivery time <i class="icon_clock_alt pull-right"></i></h4>
			<p>
				Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
			</p>
			<hr>
			<h4>Secure payment <i class="icon_creditcard pull-right"></i></h4>
			<p>
				Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
			</p>
		</div><!-- End box_style_2 -->
	</portal>
</div>
</template>

<script>
import CartItems from './CartItems.vue'

export default {
	components: {
		CartItems
	},

	data() {
		return {
			openingShortly: false,
			addresses: [],
			selectedAddress: null
		}
	},

	computed: {
		getDeliveryOption() {
			return this.$store.getters['cart/getDeliveryOption'];
		},

		getItemsCount() {
			return this.$store.getters['cart/getItemsCount'];
		},

		getSubTotal(state) {
			return this.$store.getters['cart/getSubTotal'];
		},

		getCartRestaurant() {
			return this.$store.getters['cart/getRestaurant'];
		},

		getDeliveryAddress() {
			return this.$store.getters['cart/getDeliveryAddress'];
		}
	},

	mounted() {
		if(this.getItemsCount == 0) {
			this.$router.push({
				name: 'home'
			});

			return;
		}

		if(this.getDeliveryOption == 0) {
			this.$router.push({
				name: 'checkOut'
			});

			return;
		}

		this.getAddresses();
	},

	methods: {
		goToCheckOut() {
			if(! this.selectedAddress && this.getDeliveryOption) {
				this.openingShortly = true;

				return;
			}

			this.$router.push({
				name: 'checkOut'
			});

			this.openingShortly = false;
		},

		getAddresses() {
			axios.get(`${this.$root.urls.api}/addresses`, {
				params: {
					restaurant_id: this.getCartRestaurant.id,
					sub_total: this.getSubTotal
				}
			})
 			.then(({data}) => {
 				console.log(data);

 				this.addresses = data.data;

 				this.loaded = true;
 			})
 			.catch(error => {
 				console.log(error);
 			});
		},

		formatAddress(address) {
			return `${address.street} ${address.city} ${address.state}`;
		},

		selectDeliveryAddress(address) {
			this.selectedAddress = address;

			this.$store.commit('cart/ADD_DELIVERY_ADDRESS', address);
		}
	}
}
</script>