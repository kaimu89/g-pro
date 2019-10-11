export function playerRegister({
    next,
    router
}) {
    async function user() {
        const response = await axios.get('/api/user')

        const user = response.data

        console.log(response.data)

        if (user.team_id != null || user.child_id != null) {
            return next('/myplayer')
        } else {
            return next()
        }


    }

    user()

    // return next('/');
}
