//このように定義をして{}の中にmiddlewareの処理を書く
//next()はreturnをして返す
export default function auth({
    next,
    router
}) {


    return next('/');
}
