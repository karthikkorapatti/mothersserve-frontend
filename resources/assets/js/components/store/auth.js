export default {
	namespaced: true,

	state: {
		user: {}
	},

	getters: {
		user(state) {
			return state.user;
		}
	},

	mutations: {
		INITIALIZE(state, data) {
			state.user = data.user;
		}
	}
}