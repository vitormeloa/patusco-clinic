import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Dashboard from '../views/Dashboard.vue';
import Appointments from "../views/Appointments.vue";
import CreateAppointments from "../views/CreateAppointments.vue";
import AssignDoctor from '../views/AssignDoctor.vue';
import EditAppointment from "../views/EditAppointment.vue";

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }
  },
  {
    path: '/entrar',
    name: 'Login',
    component: Login,
    meta: { guest: true }
  },
  {
    path: '/cadastro',
    name: 'Register',
    component: Register,
    meta: { guest: true }
  },
  {
    path: '/consultas',
    name: 'Appointments',
    component: Appointments,
    meta: { requiresAuth: true }
  },
  {
    path: '/consultas/nova',
    name: 'CreateAppointment',
    component: CreateAppointments,
    meta: { requiresAuth: true }
  },
  {
    path: '/consultas/:id/atribuir-medico',
    name: 'AssignDoctor',
    component: AssignDoctor,
    meta: { requiresAuth: true },
  },
  {
    path: '/consultas/:id/editar',
    name: 'EditAppointment',
    component: EditAppointment,
    meta: { requiresAuth: true }
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('auth_token');

  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: 'Login' });
  } else if (to.meta.guest && isAuthenticated) {
    next({ path: '/' });
  } else {
    next();
  }
});

export default router;
