export default {
	namespaced: true,

	state: {
		items: [],
		deliveryOption: 1
	},

	getters: {
		getDeliveryFee(state) {
			return 0;
		},

		getItems(state) {
			return state.items;
		},

		getItemsCount(state) {
			return state.items.length;
		}
	},

	mutations: {
		ADD_TO_CART(state, payload) {
			let index = -1;

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
		}
	},

	actions: {}
}