import {
  createRouter,
  createWebHistory
} from 'vue-router';
import DashboardPage from '@/views/DashboardPage.vue';
import ClientListPage from '@/views/ClientListPage.vue';
const routes = [{
    path: '/',
    name: 'Dashboard',
    component: DashboardPage
  },
  {
    path: '/clientes',
    name: 'Clientes',
    component: ClientListPage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
