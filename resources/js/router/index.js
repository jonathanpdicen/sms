import Vue from 'vue'
import VueRouter from 'vue-router'
import AuthUtils from '@/utils/auth'
import Routes from '@/constants/routes'

Vue.use(VueRouter)

const routes = require('./routes').default

const router = new VueRouter({
    mode: 'history',
    routes,
})

router.beforeEach((to, from, next) => {
    let auth_required = false;
    let guest = false;
    _.forEach(to.matched, route => {
        if (route.meta && route.meta.auth) {
            auth_required = true
        }
        if (route.meta && route.meta.guest) {
            guest = true
        }
    });
    if (auth_required) {
        if (!AuthUtils.loggedIn()) {
            next({
                name: Routes.login
            });
            return false;
        }
    } else if (guest) {
        if (AuthUtils.loggedIn()) {
            next({
                name: Routes.dashboard
            });
            return false;
        }
    }
    next()
});

export default router