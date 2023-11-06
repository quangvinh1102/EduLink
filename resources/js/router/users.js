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
            ]
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/Login.vue"),
        // beforeEnter: (to, from, next) => {
        //     if (localStorage.getItem("user_token") == null) {
        //         next();
        //     } else {
        //         next({ name: 'home' }); 
        //     }
        // },
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../pages/auth/Register.vue"),
    },
]

export default user