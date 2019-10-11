import store from '../store'

export function logAuth({
    next,
    router
}) {
    if (store.getters['auth/check']) {
        return next('/')
    } else {
        return next()
    }
}

export function auth({
    next,
    router
}) {
    if (store.getters['auth/check']) {
        return next()
    } else {
        return next('/login')
    }
}

// export {
//     logAuth,
//     auth
// }
