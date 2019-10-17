<template>
<div v-if="loaded">
	<div class="col-md-6">
		<div class="box_style_2">
			<h2 class="inner">Order confirmed!</h2>
			<div id="confirm">
				<i class="icon_check_alt2"></i>
				<h3>Thank you!</h3>
				<!-- <p>
					Lorem ipsum dolor sit amet, nostrud nominati vis ex, essent conceptam eam ad. Cu etiam comprehensam nec. Cibo delicata mei an, eum porro legere no.
				</p> -->
			</div>
			<h4>Summary</h4>
			<table class="table table-striped nomargin">
			<tbody>
				<tr v-for="menu in orderedMenu">
					<td>
						<strong>{{ menu.quantity }}x</strong> {{ menu.name }}
					</td>
					<td>
						<strong class="pull-right">Rs {{ menu.quantity * parseFloat(menu.price) }}</strong>
					</td>
				</tr>
				<tr>
					<td>
						Sub Total
					</td>
					<td>
						<strong class="pull-right">Rs {{ parseFloat(order.Order.sub_total) }}</strong>
					</td>
				</tr>
				<tr>
					<td>
						Tax
					</td>
					<td>
						<strong class="pull-right">{{ parseFloat(order.Order.tax) }} %</strong>
					</td>
				</tr>
				<tr>
					<td>
						Delivery Fee
					</td>
					<td>
						<strong class="pull-right">Rs {{ order.Order.delivery_fee_per_km }}</strong>
					</td>
				</tr>
				<tr>
					<td class="total_confirm">
						Total
					</td>
					<td class="total_confirm">
						<strong class="pull-right">Rs {{ parseFloat(order.Order.price) }}</strong>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</div><!-- End col-md-6 -->

	
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
		                           
		            <div class="col-xs-4 bs-wizard-step complete">
		              <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
		              <div class="progress"><div class="progress-bar"></div></div>
		              <a href="#0" class="bs-wizard-dot"></a>
		            </div>
		        
		          <div class="col-xs-4 bs-wizard-step complete">
		              <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
		              <div class="progress"><div class="progress-bar"></div></div>
		              <a href="cart_3.html" class="bs-wizard-dot"></a>
		            </div>  
				</div><!-- End bs-wizard --> 
		    </div><!-- End sub_content -->
		</div><!-- End subheader -->
	</portal>
</div>
</template>

<script type="text/javascript">
export default {
	data() {
		return {
			loaded: false,

			order: {}
		}
	},

	computed: {
		orderedMenu() {
			if(! this.order.hasOwnProperty('OrderMenuItem')) {
				return [];
			}

			return this.order.OrderMenuItem;
		}
	},

	mounted() {
		this.getConfirmed(this.$route.params.id);
	},

	methods: {
		getConfirmed(id) {
			if(this.loaded) {
				return;
			}

			axios.get(`${this.$root.urls.api}/orders/${id}/confirmed`)
 			.then(({data}) => {
 				console.log(data);

 				this.order = data.data[0];

 				this.loaded = true;
 			})
 			.catch(error => {
 				console.log(error);
 			});
		}
	}
}
</script>