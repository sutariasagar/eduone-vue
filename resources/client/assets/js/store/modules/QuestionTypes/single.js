function initialState() {
    return {
        item: {
            id: null,
            title: null,
            skill: null,
            module_id: [],
        },
        skillsAll: [],
        modulesAll: [],
        
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    skillsAll: state => state.skillsAll,
    modulesAll: state => state.modulesAll,
    
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

            if (_.isEmpty(state.item.skill)) {
                params.set('skill_id', '')
            } else {
                params.set('skill_id', state.item.skill.id)
            }
            if (_.isEmpty(state.item.module_id)) {
                params.delete('module_id')
            } else {
                for (let index in state.item.module_id) {
                    params.set('module_id['+index+']', state.item.module_id[index].id)
                }
            }
            if (_.isEmpty(state.item.created_by)) {
                params.set('created_by_id', '')
            } else {
                params.set('created_by_id', state.item.created_by.id)
            }
            if (_.isEmpty(state.item.updated_by)) {
                params.set('updated_by_id', '')
            } else {
                params.set('updated_by_id', state.item.updated_by.id)
            }

            axios.post('/api/v1/question-types', params)
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

            if (_.isEmpty(state.item.skill)) {
                params.set('skill_id', '')
            } else {
                params.set('skill_id', state.item.skill.id)
            }
            if (_.isEmpty(state.item.module_id)) {
                params.delete('module_id')
            } else {
                for (let index in state.item.module_id) {
                    params.set('module_id['+index+']', state.item.module_id[index].id)
                }
            }

            axios.post('/api/v1/question-types/' + state.item.id, params)
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
        axios.get('/api/v1/question-types/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchSkillsAll')
    dispatch('fetchModulesAll')
    },
    fetchSkillsAll({ commit }) {
        axios.get('/api/v1/skills')
            .then(response => {
                commit('setSkillsAll', response.data.data)
            })
    },
    fetchModulesAll({ commit }) {
        axios.get('/api/v1/modules')
            .then(response => {
                commit('setModulesAll', response.data.data)
            })
    },
    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setSkill({ commit }, value) {
        commit('setSkill', value)
    },
    setModule_id({ commit }, value) {
        commit('setModule_id', value)
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
    setSkill(state, value) {
        state.item.skill = value
    },
    setModule_id(state, value) {
        state.item.module_id = value
    },
    setSkillsAll(state, value) {
        state.skillsAll = value
    },
    setModulesAll(state, value) {
        state.modulesAll = value
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
