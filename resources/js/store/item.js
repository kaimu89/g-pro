const state = {
    //itemはages games positions ranks staffs pagination_games
    item: '',
}

const getters = {
    teams: state => !!state.item.teams ? state.item.teams : "",
    games: state => !!state.item.games ? state.item.games : "",
}

const mutations = {
    setItem(state, data) {
        state.item = data
    }
}

const actions = {
    async item(context) {
        let response = await axios.get('/api/item')

        // console.log(response.data)

        context.commit('setItem', response.data)

        // response = await axios.get(`/api/game/?page=${this.page}`);

        // context.commit('setPaginationGame', response.data)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}
