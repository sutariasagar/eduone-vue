function initialState() {
    return {
        item: {
            id: null,
            title: null,
            min_questions: null,
            max_questions: null,
            timer: null,
            is_subsection: false,
            min_time: null,
            max_time: null,
        },


        loading: false,
    }
}

const getters = {
        item: state => state.item,
    loading: state => state.loading,
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

        params.set('is_subsection', state.item.is_subsection ? 1 : 0)

        axios.post('/api/v1/exam-sections', params)
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

        params.set('is_subsection', state.item.is_subsection ? 1 : 0)

        axios.post('/api/v1/exam-sections/' + state.item.id, params)
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
        axios.get('/api/v1/exam-sections/' + id)
            .then(response => {
            commit('setItem', response.data.data)
    })


    },

    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setMin_questions({ commit }, value) {
        commit('setMin_questions', value)
    },
    setMax_questions({ commit }, value) {
        commit('setMax_questions', value)
    },
    setTimer({ commit }, value) {
        commit('setTimer', value)
    },
    setIs_subsection({ commit }, value) {
        commit('setIs_subsection', value)
    },
    setMin_time({ commit }, value) {
        commit('setMin_time', value)
    },
    setMax_time({ commit }, value) {
        commit('setMax_time', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setItem({commit}, value) {
        commit('setItem',value);
    }

}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        console.log(value, 'in mutations');
        state.item.title = value
    },
    setMin_questions(state, value) {
        state.item.min_questions = value
    },
    setMax_questions(state, value) {
        state.item.max_questions = value
    },
    setTimer(state, value) {
        state.item.timer = value
    },
    setIs_subsection(state, value) {
        state.item.is_subsection = value
    },
    setMin_time(state, value) {
        state.item.min_time = value
    },
    setMax_time(state, value) {
        state.item.max_time = value
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
