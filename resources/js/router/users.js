const user = [
    {
        path: "/",
        component: () => import("../layout/users.vue"),
        children: [
            {
                path: "",
                name: "home",
                component: () => import("../pages/HomePage.vue"),
            },
            {
                path: "profile",
                name: "profile",
                component: () => import("../pages/user/InforUser.vue"),
            },
            {
                path: "articles/:id/edit",
                name: "articles-edit",
                component: () => import("../pages/articles/Edit.vue"),
            }
        ],
            beforeEnter: (to, from, next) => {
            if (localStorage.getItem("user_token") != null) {
                console.log(localStorage.getItem("user_token"));
                next();
            } else {
                next({ name: 'login' });
            }
        },
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/Login.vue"),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem("user_token") == null) {
                console.log(localStorage.getItem("user_token"));
                next();
            } else {
                next({ name: 'home' });
            }
        },
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../pages/auth/Register.vue"),
    },
]

export default user