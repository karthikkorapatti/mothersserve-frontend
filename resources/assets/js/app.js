import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import PortalVue from 'portal-vue'

import VModal from 'vue-js-modal';
import VueTelInput from 'vue-tel-input';

// require('@/css/base.css');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.use(VueTelInput);
Vue.use(VModal, {
	dynamic: true,
});
Vue.use(PortalVue);

window.events = new Vue();

Vue.config.productionTip = false

new Vue({
	data() {
		return {
			urls: {
				base: 'http://mothersserve.test',
				api: 'http://localhost:8000/api/v1',
				media: 'https://www.mothersserve.com/mobileapp_api',
				clientUrl: 'http://mothersserve.test/mobileapp_api/api',
			}
		}
	},

	computed: {
		isLoggedIn() {
			return this.$store.getters['auth/getIsLoggedIn'];
		}
	},

	mounted() {
		this.isUserLoggedIn();
	},

	methods: {
		isUserLoggedIn() {
			axios.post(`${this.$root.urls.api}/is-loggedin`)
 			.then(({data}) => {
 				console.log(data);

 				this.$store.commit('auth/INITIALIZE', { user: data.data });
 				this.$store.commit('auth/LOGIN_SUCCESSFUL', { isLoggedIn: true });
 			})
 			.catch(error => {
 				console.log(error.response);

 				this.$store.commit('auth/INITIALIZE', { user: {} });
 				this.$store.commit('auth/LOGIN_SUCCESSFUL', { isLoggedIn: false });
 			});
		},

		handleSCroll (event) {
			let header = document.querySelector(".header-bar");

			if (window.scrollY > 50 && ! header.className.includes('sticky')) {
				header.classList.add('sticky');
			} else if (window.scrollY < 50) {
				header.classList.remove('sticky');
			}
		}
	},

	created() {
		window.addEventListener('scroll', this.handleSCroll);
	},

	destroyed() {
		window.removeEventListener('scroll', this.handleSCroll);
	},

	router,
	store,

	render: h => h(App),
}).$mount('#app')
