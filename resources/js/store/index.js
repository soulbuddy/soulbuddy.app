import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    state: {
        user: null,
        isLoading: false,
        currentUser: null,
        activeUsers: [],
        userId: null,
        articles: [],
        userUnlockedSecrets: [],
        messages: [],
        notifications: [],
        usersWithPreviousConversation: []
    },

    actions: {
        setAuthUser({commit}, userId) {
            return commit('setAuthUser', userId)
        },

        async getUserUnlockedSecrets({commit}) {
            return commit('setUserUnlockSecret', await axios.get('/secret/get_user_unlocked_secrets'))
        },

        setCurrentUser({commit}, user) {
            return commit('setCurrentUser', user)
        },

        updateActiveUsers({commit}, payload) {
            return commit('updateActiveUsers', payload)
        },

        updateUserUnlockedSecrets({commit}, secretId) {
            return commit('updateUserUnlockedSecrets', secretId);
        },

        updateMessages({commit}, message) {
            return commit('updateMessages', message)
        },

        async getAllArticles({commit}) {
            return commit('setArticles', await axios.get('/article/get_all'))
        },

        async getPaginatedArticles({commit}, page) {

            return commit('setArticles', await axios.get('/article/get_paginated_articles?page=' + page))
        },

        async refreshArticles({commit}, page) {
            return commit('refreshArticles', await axios.get('/article/get_paginated_articles?page=' + page))
        },

        /*async getCurrentUser({commit}) {
            return commit('setCurrentUser', await axios.get('/home/get_user'))
        },*/

        async getAllMessages({commit}, userId) {
            return commit('setMessages', await axios.get('/messages/get_with_user_id', {
                    params: {user_id: userId}
                }
            ))
        },

        async getAllNotifications({commit}) {
            return commit('setNotifications', await axios.get('/notifications/get_all'))
        }
    },

    mutations: {
        updateActiveUsers(state, payload) {
            if (payload.users !== undefined) {
                state.activeUsers = payload.users
            } else if (!payload.isRemove && !state.activeUsers.some(user => user.id === payload.user.id)) {
                state.activeUsers.push(payload.user);
            } else {
                state.activeUsers = state.activeUsers.filter(u => u.id != payload.user.id);
            }
        },

        updateMessages(state, message) {
            //console.log('update msg in vuex store');
            console.log('msg = ', message);
            if (state.userId == message.user_id) {
                if (state.messages[message.to_user_id])
                    state.messages[message.to_user_id].push(message);
                else state.messages.map(function (e) {
                    var o = Object.assign({}, e);
                    o.message.to_user_id = message;
                    return o;
                })
            } else {
                if (state.messages[message.user_id]) {
                    state.messages[message.user_id].push(message);
                } else {
                    state.messages.map(function (e) {
                        var o = Object.assign({}, e);
                        o.message.user_id = message;
                        return o;
                    })
                }
            }
            console.log('state msg = ', state.messages.toString())
        },
        updateUserUnlockedSecrets(state, secretId) {
            state.userUnlockedSecrets.push(secretId);
            console.log(state.userUnlockedSecrets);
        },
        setArticles(state, response) {
            //console.log('data = ', response.data.data.data);
            if (state.articles.length == 0) {
                state.articles = response.data.data.data;
            } else state.articles = [].concat(state.articles, response.data.data.data);
        },
        refreshArticles(state, response) {
            state.articles = [];
            state.articles = response.data.data.data;
        },
        setMessages(state, response) {
            console.log('state messages = ', response.data.data);
            if (response.data.data) {
                state.messages = response.data.data;
                console.log('hi')
            }
            let users = [];
            Object.keys(state.messages).forEach(function (key) {
                users[key] = state.messages[key][0].user.id == key ?
                    state.messages[key][0].user.name : state.messages[key][0].to_user.name;
            })
            state.usersWithPreviousConversation.push(users);
        },
        setAuthUser(state, userId) {
            state.userId = userId;
        },
        setCurrentUser(state, user) {
            state.currentUser = user;
        },
        setNotifications(state, response) {
            state.notifications = response.data.data;
        },
        setUserUnlockSecret(state, response) {
            let secretIds = response.data.data.map(d => d.secret_id);
            state.userUnlockedSecrets = secretIds;
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.userId !== null;
        },

        getAuthUser(state) {
            return state.userId;
        },

        getCurrentUser(state) {
            return state.currentUser;
        },

        getMessages(state) {
            return state.messages;
        },

        getActiveUsers(state) {
            return state.activeUsers;
        },

        getNotifications(state) {
            return state.notifications;
        }
    },

    strict: debug
});
