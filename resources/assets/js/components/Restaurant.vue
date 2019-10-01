<template>
<div v-if="loaded">
	<menu-container :menu="restaurant.RestaurantMenu"></menu-container>

	<portal	to="topBanner">
		<section class="parallax-window" data-parallax="scroll" data-image-src="img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
			<div id="subheader">
				<div id="sub_content">
					<div id="thumb"><img src="/img/thumb_restaurant.jpg" alt=""></div>
					<div class="rating">
						<i
							v-for="i in 5" class="icon_star"
							:class="{ voted: i <= (restaurant.hasOwnProperty('RestaurantRating') && restaurant.RestaurantRating.length) }"></i>
					</div>
					<h1>{{ restaurant.Restaurant.name }}</h1>
					<div><em>{{ restaurant.Restaurant.slogan }} / {{ restaurant.Restaurant.speciality }}</em></div>
					<div><strong>Delivery fee:</strong> {{ restaurant.Currency.symbol }} {{ restaurant.Tax.delivery_fee_per_km }}, Free over {{ restaurant.Currency.symbol }} {{ restaurant.Restaurant.min_order_price }}.</div>
				</div>
			</div>
		</section><!-- End section -->
	</portal>
</div>
</template>

<script type="text/javascript">
import moment from "moment";
import MenuContainer from './menus/Menu.vue'

export default {
	components: {
		MenuContainer
	},

	data() {
		return {
			loaded: false,
			restaurant: {}
		}
	},

	mounted() {
		this.show(this.$route.params.id);
	},

	methods:{
		toggleDropDown(){
			this.openDropDown =! this.openDropDown;
		},

		show(id) {
			axios.get(`${this.$root.urls.api}/restaurants/${id}`, {
				params: {
					current_time: moment().format('YYYY-DD-MM HH:mm:ss')
				}
			})
			.then(({ data }) => {
				console.log(data);

				this.restaurant = data.data;
				this.loaded = true;
			})
			.catch(error => {
				console.log(error);
			});
		}
	}
}
</script>