import Vue from 'vue'
import Router from 'vue-router'
import Restaurants from './components/Restaurants.vue'
import Restaurant from './components/Restaurant.vue'
import orderNow from './components/OrderNow.vue'
import Checkout from './components/Checkout.vue'
import OrderConfirmed from './components/OrderConfirmed.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Restaurants
    },
    {
      path: '/restaurants/:id',
      name: 'restaurants.show',
      component: Restaurant
    },
    {
      path: '/order-now',
      name: 'orderNow',
     component: orderNow
    },
    {
      path: '/checkout',
      name: 'checkOut',
     component: Checkout
    },
    {
      path: '/orders/:id/confirmed',
      name: 'orderConfirmed',
     component: OrderConfirmed
    }
  ],

  scrollBehavior (to, from, savedPosition) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve({ x: 0, y: 0 })
      }, 10)
    })
  },

})
