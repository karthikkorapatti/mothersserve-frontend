<template>
<div>
	<app-header></app-header>

	<banner></banner>

	<breadcrumbs></breadcrumbs>

	<div class="container margin_60_35">
		<div class="row">
			<main-menu></main-menu>
			<router-view></router-view>
		</div>
	</div>

	<app-footer></app-footer>

	<modals-container/>
</div>
</template>

<script>
import AppHeader from './Header.vue'
import Banner from './Banner.vue'
import Breadcrumbs from './Breadcrumbs.vue'
import MainMenu from './MainMenu.vue'
import AppFooter from './Footer.vue'

export default {
	components: {
		AppHeader, Banner, Breadcrumbs, MainMenu, AppFooter
	},
	data() {
		return {
		}
	},
	methods: {
	},
}
</script>