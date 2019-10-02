 <template>
 <div v-if="loaded">
 	<portal	to="topBanner">
		<!-- SubHeader =============================================== -->
		<section class="parallax-window" id="short" data-parallax="scroll"
			style="background-image: url(/images/banner.png); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;" 
			data-image-src="img/sub_header_short.jpg" data-natural-width="1400" data-natural-height="350">
		<div id="subheader">
			<div id="sub_content">
				<h1>Welcome to Mother's Serve</h1>
				<div><i class="icon_pin"></i> Rajarajeshwari Nagar, Bengaluru.</div>
			</div><!-- End sub_content -->
		</div><!-- End subheader -->
		</section><!-- End section -->
		<!-- End SubHeader ============================================ -->
	</portal>

 	<div class="col-md-9">
    	<div id="tools">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
					<!-- <div class="styled-select">
						<select name="sort_rating" id="sort_rating">
							<option value="" selected>Sort by ranking</option>
							<option value="lower">Lowest ranking</option>
							<option value="higher">Highest ranking</option>
						</select>
					</div> -->
				</div>
				<div class="col-md-9 col-sm-9 hidden-xs">
					<!-- <a href="grid_list.html" class="bt_filters"><i class="icon-th"></i></a> -->
				</div>
			</div>
		</div><!--End tools -->
        
		<div class="strip_list wow fadeIn" data-wow-delay="0.3s"
			v-for="restaurant in restaurants">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<div class="desc">
						<div class="thumb_strip">
							<router-link :to="{name: 'restaurants.show', params: {id: restaurant.Restaurant.id}}">
								<img :src="`${$root.urls.media}/${restaurant.Restaurant.image}`" alt=""/>
							</router-link>
						</div>
						<div class="rating">
							<i
								v-for="i in 5" class="icon_star" :class="{ voted: i <= restaurant.RestaurantRating.length }"></i>
							<!-- (<small><a href="javascript:void(0);">98 reviews</a></small>) -->
						</div>
						<h3>
							<router-link :to="{name: 'restaurants.show', params: {id: restaurant.Restaurant.id}}">{{ restaurant.Restaurant.name }}</router-link>
						</h3>
						<div class="type">
							{{ restaurant.Restaurant.slogan }} / {{ restaurant.Restaurant.speciality }}
						</div>
						<div class="location">
							<strong>Delivery charge:</strong> {{ restaurant.Currency.symbol }} {{ restaurant.Tax.delivery_fee_per_km }}, Free over {{ restaurant.Currency.symbol }} {{ restaurant.Restaurant.min_order_price }}
						</div>
						<div class="location">
							<strong>Preparation time</strong> : {{ restaurant.Restaurant.preparation_time }} min - <strong>Delivery Time</strong>: {{ restaurant.Tax.delivery_time }} min
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="go_to">
						<div>
							<router-link :to="{name: 'restaurants.show', params: {id: restaurant.Restaurant.id}}" class="btn_1">View Menu</router-link>
						</div>
					</div>
				</div>
			</div><!-- End row-->
		</div><!-- End strip_list-->
	</div><!-- End col-md-9-->
 </div>
 </template>

 <script>
 export default {
 	data() {
 		return {
 			loaded: false,
 			restaurants: []
 		}
 	},

 	mounted() {
 		this.get();
 	},

 	methods: {
 		formatPrice(restaurant) {

 		},

 		get() {
 			axios.get(`${this.$root.urls.api}/restaurants`)
 			.then(({data}) => {
 				console.log(data);

 				this.restaurants = data.data;

 				this.loaded = true;
 			})
 			.catch(error => {
 				console.log(error);
 			});
 		}
 	}
 }
 </script>