<template>
<div>
	<h3 class="nomargin_top" id="starters">{{ items.name }}</h3>
	<p>{{ items.description }}</p>
	<table class="table table-striped cart-list">
		<thead>
			<tr>
				<th>Item</th>
				<th>Price</th>
				<th>Order</th>
			</tr>
		</thead>
		<tbody>
			<item v-for="item in items.RestaurantMenuItem" :item="item" :key="`item-${item.id}`"></item>
			<hr/>
		</tbody>
	</table>
</div>
</template>

<script>
import Item from './Item.vue';

export default {
	components: {
		Item
	},

	props: {
		items: {
			required: true,
			type: Object
		}
	}
}
</script>