function initialState() {
    return {
        item: {
            id: null,
            title: null,
            description: null,
            industry: null,
            credit: null,
        },
        industriesAll: [],

        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    industriesAll: state => state.industriesAll,
    
}

const actions = {
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.industry)) {
                params.set('industry_id', '')
            } else {
                params.set('industry_id', state.item.industry.id)
            }

            axios.post('/api/v1/courses', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (_.isEmpty(state.item.industry)) {
                params.set('industry_id', '')
            } else {
                params.set('industry_id', state.item.industry.id)
            }

            axios.post('/api/v1/courses/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        axios.get('/api/v1/courses/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchIndustriesAll')
    },
    fetchIndustriesAll({ commit }) {
        axios.get('/api/v1/industries')
            .then(response => {
                commit('setIndustriesAll', response.data.data)
            })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setDescription({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'description', { root: true });
        commit('setDescription', value)
    },
    setIndustry({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'industry', { root: true });
        commit('setIndustry', value)
    },
    setCredit({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'credit', { root: true });
        commit('setCredit', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setDescription(state, value) {
        state.item.description = value
    },
    setIndustry(state, value) {
        state.item.industry = value
    },
    setCredit(state, value) {
        state.item.credit = value
    },
    setIndustriesAll(state, value) {
        state.industriesAll = value
    },
    
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
