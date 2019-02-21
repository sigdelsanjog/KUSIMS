import Vue from "vue";
import VueRouter from "vue-router";
import {
    Home,
    Login,
    Register,
    Dashboard,
    DashView,
    CreateAuthor,
    PageNotFound,
    UnAuthorized,
    StudentList,
    StudentCreate,
    Silent,
    Profile
} from "../modules";
import Store from "./../stores";

Vue.use(VueRouter);

const routes = [
    {
        path: "/login",
        component: Login,
        name: "auth.login"
    },
    {
        path: "/register",
        component: Register,
        name: "auth.register"
    },
    {
        path: "/",
        component: DashView,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: "dashboard",
                alias: "",
                component: Dashboard,
                name: "Dashboard"
            },
            {
                path: "profile",
                alias: "",
                component: Profile,
                name: "Profile"
            },
            {
                path: 'student',
                component: {
                  render (c) { return c('router-view') }
                },
                children: [
                  {
                    path: '',
                    meta: { label: 'Student List'},
                    component: StudentList,
                  },
                  {
                    path: 'create',
                    component: StudentCreate,
                  },
                  {
                    path: ':id',
                    meta: { label: 'Student Details'},
                    name: 'Student Edit',
                    component: StudentCreate,
                  },
                ]
              },
        ]
    },
    { path: "*", component: PageNotFound },
    { path: "/unauthorized", component: UnAuthorized },
    { path: "/silent", component: Silent }
];

const router = new VueRouter({
    routes,
    linkActiveClass: "active",
    mode: "history"
});

router.beforeEach((to, from, next) => {
    debugger;
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = Store.getters["global/currentUser"];
    const isLoggedIn = Store.getters["global/isLoggedIn"];

    if (isLoggedIn) {
        axios.defaults.headers.common["Authorization"] = `Bearer ${
            currentUser.token
        }`;
    }
    if (requiresAuth && !isLoggedIn) {
        next("/login");
    } else if (
        (to.path === "/login" && isLoggedIn) ||
        (to.path === "/register" && isLoggedIn)
    ) {
        next("/dashboard");
    } else {
        next();
    }
});

export default router;
