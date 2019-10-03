<template>
<header class="header-bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col--md-4 col-sm-4 col-xs-4">
				<router-link :to="{name: 'home'}" id="logo">
					<!-- <img src="img/logo.png" width="190" height="23" alt="" data-retina="true" class="hidden-xs">
					<img src="img/logo_mobile.png" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm"> -->
					<span>Mother's Serve</span>
				</router-link>
			</div>
			<nav class="col--md-8 col-sm-8 col-xs-8">
			<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
			<div class="main-menu">
				<div id="header_menu">
					<img src="img/logo.png" width="190" height="23" alt="" data-retina="true">
				</div>
				<a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
				 <ul>
				 	<template v-if="isLoggedIn">
				 		<li class="submenu">
	                    <a href="javascript:void(0);" class="show-submenu">{{ userFullName }}<i class="icon-down-open-mini"></i></a>
	                    <ul>
	                        <li><a href="javascript:void(0);" @click="logout()">Logout</a></li>
	                    </ul>
	                    </li>
				 	</template>
				 	<template v-else>
						<li>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#login" @click="login()">Login</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#register" @click="register()">Register</a>
						</li>
				 	</template>
				</ul>
			</div><!-- End main-menu -->
			</nav>
		</div><!-- End row -->
	</div><!-- End container -->
</header>
</template>

<script>
import Login from './auth/Login';
import Register from './auth/Register';

export default {
	data() {
		return {
			
		}
	},

	computed: {
		user() {
			return this.$store.getters['auth/getUser'];
		},

		isLoggedIn() {
			return this.$store.getters['auth/getIsLoggedIn'];
		},

		userFullName() {
			if(this.user && this.user.hasOwnProperty('User') && this.user.hasOwnProperty('UserInfo')) {
				return `${this.user.UserInfo.first_name} ${this.user.UserInfo.first_name}`;
			}

			return '';
		}
	},

	mounted() {
		this.loadEvents();
	},

	methods: {
		login() {
			if(this.isLoggedIn) {
				return;
			}

			this.$modal.show(Login, {}, {
				name: 'modal:users:login',
				height: 'auto',
				clickToClose: false
			});
		},

		register() {
			if(this.isLoggedIn) {
				return;
			}

			this.$modal.show(Register, {}, {
				name: 'modal:users:register',
				height: 'auto',
				clickToClose: false
			});
		},

		logout() {
			axios.post(`${this.$root.urls.api}/logout`)
 			.then(({data}) => {
 				console.log(data);

 				this.$store.commit('auth/INITIALIZE', { user: {} });
 				this.$store.commit('auth/LOGIN_SUCCESSFUL', { isLoggedIn: false });

 				window.location.reload();
 			})
 			.catch(error => {
 				console.log(error.response);
 			});
		},

		loadEvents() {
			window.events.$on(
				'login:requested', (data) => {
					if(data) {
						if(!this.isLoggedIn) {
							this.login();
						}
					}
				}
			);
		}
	},
}
</script>