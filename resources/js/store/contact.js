const state = {
    contact: {},
}

const getters = {

}

const mutations = {
    setContact(state, data) {
        state.contact.name = data.name
        state.contact.email = data.email
        state.contact.title = data.title
        state.contact.body = data.body
    },
    setNull(state) {
        state.contact = {}
    }
}

const actions = {}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}
