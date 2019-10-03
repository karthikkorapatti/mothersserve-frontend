export default {
	namespaced: true,

	state: {
		user: {},
		isLoggedIn: false
	},

	getters: {
		getUser(state) {
			return state.user;
		},

		getIsLoggedIn(state) {
			return state.isLoggedIn;
		}
	},

	mutations: {
		INITIALIZE(state, data) {
			state.user = data.user;
		},

		LOGIN_SUCCESSFUL(state, data) {
			state.isLoggedIn = data.isLoggedIn;
		}
	}
}