import Vue from 'vue'
import Vuex from 'vuex'
import auth from './components/store/auth'
import cart from './components/store/cart'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {

	},

	mutations: {

	},

	actions: {

	},

	modules: {
		auth,
		cart
	},

	strict: process.env.NODE_ENV !== 'production'
})
