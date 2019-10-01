import Vue from 'vue'
import Router from 'vue-router'
import Restaurants from './components/Restaurants.vue'
import Restaurant from './components/Restaurant.vue'
import orderNow from './components/OrderNow.vue'
import Checkout from './components/Checkout.vue'
import ConfirmOrder from './components/ConfirmOrder.vue'

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
      path: '/orderNow',
      name: 'orderNow',
     component: orderNow
    },
    {
      path: '/Checkout',
      name: 'Checkout',
     component: Checkout
    },
    {
      path: '/ConfirmOrder',
      name: 'ConfirmOrder',
     component: ConfirmOrder
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
