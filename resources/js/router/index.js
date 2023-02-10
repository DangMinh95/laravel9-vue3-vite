import {createRouter, createWebHistory} from 'vue-router'
import login from '../views/Login.vue'
import product from '../views/Product.vue'
import upload from '../views/UploadFile.vue'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: login
  },
  {
    path: '/product',
    name: 'product',
    component: product
  },
  {
    path: '/upload',
    name: 'upload',
    component: upload
  }
]
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
