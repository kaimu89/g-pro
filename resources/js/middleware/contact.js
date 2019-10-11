import store from '../store'

export function confirmMDW({
    next,

    to,
    router
}) {

    if (!!store.state.contact.contact.name) {
        return next()
    } else {
        return next('/contact')
    }
}

export function contactMDW({
    next,
    router,
    redirect
}) {
    const path = router.apps[0]._route.path

    if (path != '/confirm') {
        const response = store.commit("contact/setNull");
    }

    return next()
}
