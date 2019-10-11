import {
    SSL_OP_ALLOW_UNSAFE_LEGACY_RENEGOTIATION
} from "constants";
import {
    throws
} from "assert";

import item from './item'
import {
    OK,
    UNPROCESSABLE_ENTITY,
    CREATED
} from '../util'

const state = {
    user: null,
    apiStatus: null,
    loginErrorMessages: null,
    registerErrorMessages: null
}

const getters = {
    check: state => !!state.user,
    username: state => state.user ? state.user.user_name : '',
    user: state => state.user ? state.user : '',
    proama: state => !!state.user.team ? state.user.team.proama : "",
    notices: state => {
        // if (state.user.player != null) {
        //     if (state.user.player.scoutusers != null) {
        //         return state.user.player.scoutusers
        //     }
        // }
        return "hello";
    }
}

const mutations = {
    setUser(state, user) {
        state.user = user
    },
    setApiStatus(state, status) {
        state.apiStatus = status
    },
    setLoginErrorMessages(state, messages) {
        state.loginErrorMessages = messages
    },
    setRegisterErrorMessages(state, messages) {
        state.registerErrorMessages = messages
    }
    // setProfile(state, data) {
    //     state.user.user_name = data.user_name
    //     state.user.first_name = data.first_name
    //     state.user.last_name = data.last_name
    //     state.user.gender = data.gender
    //     state.user.twitter = data.twitter
    //     state.user.birthday = data.birthday
    // },
    // setEmail(state, data) {
    //     state.user.email = data.email
    // },
    // setLeader(state, data) {
    //     state.user.leader = null
    //     state.user.team.users.forEach(user => {
    //         // user.id == data ? user.leader = 0 : null
    //         if (user.id == data) {
    //             user.leader = 0
    //             console.log('leader0')
    //         }
    //         if (user.id == state.user.id) {
    //             user.leader = null

    //             console.log(user + 'null')
    //         }
    //     })
    // },
    // setPlayer(state, player) {
    //     state.user.player.ign = player.ign
    //     state.user.player.game_id = player.game_id
    //     state.user.player.position_id = player.position_id
    //     state.user.player.rank_id = player.rank_id
    //     state.user.player.proama = player.proama
    //     state.user.player.description = player.description

    //     state.user.player.game = item.state.item.games[player.game_id - 1]
    //     state.user.player.position = item.state.item.positions[player.position_id - 1]
    //     state.user.player.rank = item.state.item.ranks[player.rank_id - 1]
    // },
    // setMyTeam(state, data) {
    //     state.user.team.name = data.name
    //     state.user.team.mail = data.mail
    //     state.user.team.hp = data.hp
    //     state.user.team.top = data.top
    //     state.user.team.description = data.description
    // }
}

const actions = {
    async register(context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/register', data)

        context.commit('setUser', response.data)

        if (response.status === CREATED) {
            context.commit('setApiStatus', true)
            context.commit('setUser', response.data)
            return false
        }

        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setRegisterErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, {
                root: true
            })
        }
    },

    async login(context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/login', data)

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', response.data)
            return false
        }

        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setLoginErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, {
                root: true
            })
        }
    },
    async logout(context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.post('../../api/logout')

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', null)
            return false
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, {
            root: true
        })
    },
    async currentUser(context) {
        context.commit('setApiStatus', null)
        //ここ階層を一段落とすと出来るようになる。理由は不明
        const response = await axios.get('../../api/user')

        console.log(response.data)
        const user = response.data || null

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', user)
            return false
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, {
            root: true
        })
    },
    // async profileEdit(context, data) {

    //     console.log('profileEdit前')

    //     console.log(data)

    //     const response = await axios.post('api/profile/edit', data)

    //     console.log('profileEdit後')
    //     console.log(response.data)

    //     context.commit("setProfile", response.data)
    // },
    // async profileEmail(context, data) {
    //     console.log(data)

    //     const response = await axios.post('api/profile/email', data)

    //     console.log(response.data)

    //     context.commit("setEmail", response.data)
    // },
    // async myTeamEdit(context, data) {

    //     console.log(data)

    //     const response = await axios.post('api/myteam/edit', data)

    //     console.log(response.data)

    //     context.commit("setMyTeam", response.data)
    // },
    // async myPlayerEdit(context, data) {
    //     // console.log(data)

    //     const response = await axios.post('api/myplayer/edit', data)

    //     console.log(response.data)

    //     context.commit('setPlayer', response.data)
    // },
    // async leader(context, data) {

    //     console.log(data)

    //     const response = await axios.post('api/myteam/member/leader', data)

    //     context.commit('setLeader', response.data)
    // }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
