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
		}
	},

	mutations: {
		ADD_TO_CART(state, payload) {
			console.log(payload);
			let index = -1;

			for(let i in state.items) {
				if(state.items[i].entry.id == payload.entry.id) {
					index = i;
				}
			}

			if(index < 0) {
				state.items.push(payload);
			} else {
				console.log('hello');
				state.items.splice(index, 1, payload);
			}
		}
	},

	actions: {}
}