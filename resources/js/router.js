import Vue from 'vue'
import VueRouter from 'vue-router'
import {
    logAuth,
    auth
} from './middleware/auth'
import {
    contactMDW,
    confirmMDW
} from './middleware/contact'

import SystemError from './pages/errors/System.vue'
import NotFound from './pages/errors/NotFound.vue'
import index from './pages/index.vue'
import login from './pages/login.vue'
import register from './pages/register.vue'
import team from './pages/team.vue'
import game from './pages/game.vue'
import player from './pages/player.vue'
import findteam from './pages/findteam.vue'
import addPlayer from './pages/addPlayer.vue'
import addTeam from './pages/addTeam.vue'
import addPro from './pages/addPro.vue'
import recruitTeamGene from './pages/recruitTeamGene.vue'
import recruitTeamPro from './pages/recruitTeamPro.vue'
import recruitStaff from './pages/recruitStaff.vue'
import contact from './pages/contact.vue'
import confirm from './pages/confirm.vue'
import profile from './pages/profile.vue'
import profileEdit from './pages/profileEdit.vue'
import profileEmail from './pages/profileEmail.vue'
import profilePassword from './pages/profilePassword.vue'
import myteam from './pages/myteam.vue'
import myteamEdit from './pages/myteamEdit.vue'
import myteamMember from './pages/myteamMember.vue'
import myteamChild from './pages/myteamChild.vue'
import myteamRecruit from './pages/myteamRecruit.vue'
import myplayer from './pages/myplayer.vue'
import myplayerEdit from './pages/myplayerEdit.vue'
import trypage from './pages/try.vue'

import store from './store'
import Axios from 'axios';

Vue.use(VueRouter)

//middlewareの使い方
// //ルートのオブジェクトに
// meta: {
//     middleware: ここにmiddleware
// }

//複数
// meta: {
//     middleware: [auth, log],
// },
//このように指定する

const routes = [{
        path: '/',
        component: index
    },
    {
        path: '/500',
        component: SystemError
    },
    {
        path: '*',
        component: NotFound
    },
    {
        path: '/try',
        component: trypage,
    },
    {
        path: '/login',
        component: login,
        meta: {
            middleware: logAuth
        }
    },
    {
        path: '/register',
        component: register,
        meta: {
            middleware: logAuth
        }
    },

    //ログインなし
    {
        path: '/team',
        component: team,
        props: route => {
            const page = route.query.page
            return {
                page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1
            }
        },
    },
    {
        path: '/game',
        component: game,
        props: route => {
            const page = route.query.page
            return {
                page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1
            }
        }
    },
    {
        path: '/player',
        component: player,
        props: route => {
            const page = route.query.page
            return {
                page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1
            }
        }
    },
    {
        path: '/findteam',
        component: findteam,
        props: route => {
            const page = route.query.page
            return {
                page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1
            }
        }
    },
    {
        path: '/contact',
        component: contact,
        meta: {
            middleware: contactMDW
        }
    },
    {
        path: '/confirm',
        component: confirm,
        meta: {
            middleware: confirmMDW
        }
    },

    //------------------------------------
    //ログインあり


    {
        path: '/profile',
        component: profile,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/profile/edit',
        component: profileEdit,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/profile/email',
        component: profileEmail,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/profile/password',
        component: profilePassword,
        meta: {
            middleware: auth
        }
    },


    {
        path: '/myplayer',
        component: myplayer,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/myplayer/edit',
        component: myplayerEdit,
        meta: {
            middleware: auth
        }
    },


    {
        path: '/myteam',
        component: myteam,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/myteam/edit',
        component: myteamEdit,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/myteam/member',
        component: myteamMember,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/myteam/child/:id',
        component: myteamChild,
        props: route => ({
            id: Number(route.params.id)
        }),
        meta: {
            middleware: auth
        }
    },
    {
        path: '/myteam/recruit/:id',
        component: myteamRecruit,
        props: route => ({
            id: Number(route.params.id)
        }),
        meta: {
            middleware: auth
        }
    },


    {
        path: '/add/player',
        component: addPlayer,
        meta: {
            middleware: auth,
        }
    },
    {
        path: '/add/team',
        component: addTeam,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/add/pro',
        component: addPro,
        meta: {
            middleware: auth
        }
    },


    {
        path: '/recruit/team/gene',
        component: recruitTeamGene,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/recruit/team/pro',
        component: recruitTeamPro,
        meta: {
            middleware: auth
        }
    },
    {
        path: '/recruit/staff',
        component: recruitStaff,
        meta: {
            middleware: auth
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes
})

//middlewareの実装
//https://markus.oberlehner.net/blog/implementing-a-simple-middleware-with-vue-router/

function nextFactory(context, middleware, index) {

    const subsequentMiddleware = middleware[index];

    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({
            ...context,
            next: nextMiddleware
        });
    };
}

router.beforeEach((to, from, next) => {
    //to.meta.middlewareでそのルートのメタにアクセス出来る。
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware) ?
            to.meta.middleware : [to.meta.middleware];

        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({
            ...context,
            next: nextMiddleware
        });
    }

    return next();
});


// -----------------------------------------

export default router
