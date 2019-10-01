<template>
<div>
	<div class="col-md-6">
		<div class="box_style_2" id="main_menu">
			<h2 class="inner">Menu</h2>
			<category
				v-for="items in menu"
				:items="items"
				:key="`menu-category-${items.id}`"></category>
		</div>
	</div>

	<cart-items></cart-items>

	<portal to="destination">
		<router-link to="/OrderNow" class="btn_full">Order now</router-link>
	</portal>

	<portal	to="sideBarLeft">
		<p><router-link :to="{ name: 'home' }" class="btn_side">Back to search</router-link></p>
		<div class="box_style_1">
			<ul id="cat_nav">
				<li v-for="(items, index) in menu"><a :href="`#${items.name}`" :class="{
					active: index == 0
				}">{{ items.name }}</a></li>
			</ul>
		</div><!-- End box_style_1 -->		
	</portal>
</div>
</template>

<script>
import CartItems from './../CartItems.vue'
import Category from './List.vue';

export default {
	components: {
		CartItems,
		Category
	},

	props: {
		menu: {
			required: true,
			type: Array
		}
	},

	data() {
		return {}
	},

	mounted() {

	},

	methods: {
		toggleDropDown() {
			this.openDropDown =! this.openDropDown;
		}
	}
}
</script>