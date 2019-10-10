<template>
<div>
	<div class="col-md-6">
		<div class="box_style_2">
			<h2 class="inner">Payment methods</h2>
			<div class="payment_select" id="paypal">
				<label><input type="radio" value="1" name="payment_method" class="icheck"
					:checked="getPaymentMethod == 1"
					@click="selectPaymentMethod(1)">Pay with Instamojo</label>
			</div>
			<div class="payment_select nomargin">
				<label><input type="radio" value="0" name="payment_method" class="icheck"
					:checked="getPaymentMethod == 0"
					@click="selectPaymentMethod(0)">Pay with cash</label>
				<i class="icon_wallet"></i>
			</div>
		</div><!-- End box_style_1 -->
	</div><!-- End col-md-6 -->

	<cart-items></cart-items>

	<portal to="topBanner">
		<div id="subheader">
			<div id="sub_content">
			 	<h1>Place your order</h1>
		        <div class="bs-wizard">
		            <div class="col-xs-4 bs-wizard-step complete">
		              <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
		              <div class="progress"><div class="progress-bar"></div></div>
		              <a href="cart.html" class="bs-wizard-dot"></a>
		            </div>
		                           
		            <div class="col-xs-4 bs-wizard-step active">
		              <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
		              <div class="progress"><div class="progress-bar"></div></div>
		              <a href="#0" class="bs-wizard-dot"></a>
		            </div>
		        
		          <div class="col-xs-4 bs-wizard-step disabled">
		              <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
		              <div class="progress"><div class="progress-bar"></div></div>
		              <a href="cart_3.html" class="bs-wizard-dot"></a>
		            </div>  
				</div><!-- End bs-wizard --> 
		    </div><!-- End sub_content -->
		</div><!-- End subheader -->
	</portal>

	<portal to="destination">
		<a href="javascript:void(0);" @click="confirmOrder()" class="btn_full">Confirm your order</a>
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
import Loader from './Loader';

export default {
	components: {
		CartItems
	},

	data() {
		return {

		}
	},

	computed: {
		getItemsCount() {
			return this.$store.getters['cart/getItemsCount'];
		},

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

		getDeliveryOption() {
			return this.$store.getters['cart/getDeliveryOption'];
		},

		getDeliveryAddress() {
			return this.$store.getters['cart/getDeliveryAddress'];
		},

		getPaymentMethod() {
			return this.$store.getters['cart/getPaymentMethod'];
		},

		getCartRestaurant() {
			return this.$store.getters['cart/getRestaurant'];
		},

		getRiderTip() {
			return this.$store.getters['cart/getRiderTip'];
		},
	},

	mounted() {
		if(this.getItemsCount == 0) {
			this.$router.push({
				name: 'home'
			});

			return;
		}
	},

	methods: {
		confirmOrder() {
			this.$modal.show(Loader, {}, {
				name: 'modal:loader',
				height: 'auto',
				clickToClose: false
			});

			axios.post(`${this.$root.urls.api}/confirm-order`, this.prepareData())
 			.then(({data}) => {
 				console.log(data);

 				this.$store.commit('cart/EMPTY_CART');
 				this.$modal.hide('modal:loader');
 			})
 			.catch(error => {
 				console.log(error);

 				this.$store.commit('cart/EMPTY_CART');
 				this.$modal.hide('modal:loader');
 			});

		},

		selectPaymentMethod(value) {
			this.$store.commit('cart/ADD_PAYMENT_METHOD', value);
		},

		prepareData() {
			let data = {};

			data.quantity = this.getItemsCount;
			data.sub_total = this.getSubTotal;
			data.delivery_fee = this.getDeliveryFee;
			data.tax = this.getTax;
			data.delivery = this.getDeliveryOption;
			data.payment_method = this.getPaymentMethod;
			data.restaurant_id = this.getCartRestaurant.id;
			data.address_id = this.getDeliveryAddress? this.getDeliveryAddress.id : 0;
			data.rider_tip = this.getRiderTip;
			data.instructions = '';
			data.coupon_id = 0;
			data.items = this.getCartItems;

			return data;
		}
	}
}
</script>