<template>
<tr>
	<td>
		<h5>{{ item.name }}</h5>
		<p>{{ item.description }}</p>
	</td>
	<td>
		<strong>Rs {{ item.price }}</strong>
	</td>
	<td class="options">
		<div class="dropdown dropdown-options"
			:class="{open: dropDown}"
			:ref="`menuItems${item.id}`">
			<a  class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" @click="toggleDropdown">
				<i class="" :class="[ dropDown ? 'icon_minus_alt2' : 'icon_plus_alt2' ]"></i>
			</a>
			<div class="dropdown-menu">
				<h5>Instructions</h5>
				<label>
					<textarea placeholder="Special Instructions (optional)"></textarea>
				</label>
				<button @click="decrementOrderCount">-</button>
				<label>
					<input type="text" v-model="orderCount">
				</label>
				<button @click="incrementOrderCount">+</button>
				<label>
					<a href="#0" class="add_to_basket">Add to cart <span>{{ `Rs ${totalOrderCount}` }}</span></a>
				</label>
			</div>
		</div>
	</td>
</tr>
</template>

<script>
export default {
	props: {
		item: {
			required: true,
			type: Object
		}
	},

	data() {
		return {
			dropDown: false,
			orderCount: 1
		}
	},

	computed: {
		totalOrderCount() {
			return this.item.price * this.orderCount;
		}
	},

	mounted() {
		document.addEventListener('click', this.close);
	},

	methods: {
		toggleDropdown (e) {
			this.dropDown = !this.dropDown;

			e.stopPropagation();
		},

		close (e) {
			if (!this.$refs[`menuItems${this.item.id}`].contains(e.target)) {
				this.dropDown = false;
			}
		},

		incrementOrderCount() {
			this.orderCount++;
		},

		decrementOrderCount() {
			if(this.orderCount <= 1) {
				this.orderCount = 1;

				return;
			}

			this.orderCount--;
		}
	},

	beforeDestroy() {
		document.removeEventListener('click', this.close);
	}
}
</script>