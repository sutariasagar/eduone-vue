function initialState() {
    return {
        item: {
            reading:{},
            writing:{},
            speaking:{},
            listening_rol:{},
            listening_sst:{},
        },
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
}

const actions = {
    storeData({ commit, state, dispatch }, section) {
        console.log(section);
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item[section.type]) {
                let fieldValue = state.item[section.type][fieldName];
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

            params.set('is_subsection', state.item[section.type].is_subsection ? 1 : 0)

            axios.post('/api/v1/exam-sections/' + state.item[section.type].id, params)
                .then(response => {
                    //commit('setItem', { value :response.data.data, section: section.type })
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

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

            params.set('is_subsection', state.item.is_subsection ? 1 : 0)

            axios.post('/api/v1/exam-sections/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

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
        axios.get('/api/v1/exam-sections/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        
    },
    setTitle({ commit }, { value, section }) {
        commit('setTitle', value)
    },
    
    setMin_questions({ commit }, { value, section }) {
        commit('setMin_questions', { value, section })
    },
    setMax_questions({ commit }, { value, section }) {
        commit('setMax_questions', { value, section })
    },
    setTimer({ commit }, { value, section }) {
        commit('setTimer', { value, section })
    },
    setIs_subsection({ commit }, { value, section }) {
        commit('setIs_subsection', { value, section })
    },
    setMin_time({ commit }, { value, section }) {
        commit('setMin_time', { value, section })
    },
    setMax_time({ commit }, { value, section }) {
        commit('setMax_time', { value, section })
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setItem({ commit }, { value, section }) {
        commit('setItem', { value, section });
    },
    createItem({ commit }, value) {
        commit('createItem', value);
    },

}

const mutations = {
    setItem(state, { item, section }) {
        state.item[section.type] = item
    },
    createItem(state, item) {
        state.item[item.type] = item;
    },
    setTitle(state, { value, section }) {
        state.item[section.type].title = value
    },

    setMin_questions(state, { value, section }) {
        state.item[section.type].min_questions = value
    },
    setMax_questions(state, { value, section }) {
        state.item[section.type].max_questions = value
    },
    setTimer(state, { value, section }) {
        state.item[section.type].timer = value
    },
    setIs_subsection(state, { value, section }) {
        state.item[section.type].is_subsection = value
    },
    setMin_time(state, { value, section }) {
        state.item[section.type].min_time = value
    },
    setMax_time(state, { value, section }) {
        state.item[section.type].max_time = value
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
