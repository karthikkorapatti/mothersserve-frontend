export default {
	namespaced: true,

	state: {
		items: [],
		deliveryOption: 1,
		raiderTip: 0,
		deliveryFee: 0,
		tax: 0,
		restaurant: '',
		address: null
	},

	getters: {
		getDeliveryFee(state) {
			return 0;
		},

		getRaiderTip(state) {
			return state.raiderTip;
		},

		getTax(state) {
			return state.tax;
		},

		getSubTotal(state) {
			if(! state.items.length) {
				return 0;
			}

			let total = 0;

			state.items.forEach((item) => {
				total += (item.entry.price * item.quantity);
			});

			return total;
		},

		getItems(state) {
			return state.items;
		},

		getItemsCount(state) {
			return state.items.length;
		},

		getDeliveryOption(state) {
			return state.deliveryOption;
		},

		getRestaurant(state) {
			return state.restaurant;
		},

		getDeliveryAddress(state) {
			return state.address;
		},
	},

	mutations: {
		ADD_TO_CART(state, payload) {
			let index = -1;

			if(! state.items.length) {
				state.restaurant = payload.restaurant;
				state.tax = payload.tax;
			}

			for(let i in state.items) {
				if(state.items[i].entry.id == payload.entry.id) {
					index = i;

					break;
				}
			}

			if(index < 0) {
				state.items.push(payload);
			} else {
				state.items.splice(index, 1, payload);
			}
		},

		REMOVE_FROM_CART(state, payload) {
			let index = -1;

			for(let i in state.items) {
				if(state.items[i].entry.id == payload.entry.id) {
					index = i;

					break;
				}
			}

			if(index > -1) {
				state.items.splice(index, 1);
			}
		},

		EMPTY_CART(state, payload) {
			state.items = [];
			state.deliveryOption = 1;
			state.raiderTip = 0;
			state.deliveryFee = 0;
			state.tax = 0;
			state.restaurant = '';
			state.address = null;
		},

		CHANGE_DELIVERY_OPTION(state, payload) {
			state.deliveryOption = payload;

			if(! payload) {
				state.deliveryFee = 0;
			}
		},

		ADD_DELIVERY_ADDRESS(state, payload) {
			state.address = payload;
		}
	},

	actions: {}
}