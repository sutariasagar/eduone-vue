function initialState() {
    return {
        item: {
            id: null,
            title: null,
            enabling_skill: null,
        },
        loading: false,
        enablingSkillsAll: [],
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    enablingSkillsAll: state => state.enablingSkillsAll
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

              if (_.isEmpty(state.item.enabling_skill)) {
                params.set('enabling_skill_id', '')
              } else {
                params.set('enabling_skill_id', state.item.enabling_skill.id)
              }
            axios.post('/api/v1/skills', params)
                .then(response => {
                    commit('resetState')
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
              if (_.isEmpty(state.item.enabling_skill)) {
                params.set('enabling_skill_id', '')
              } else {
                params.set('enabling_skill_id', state.item.enabling_skill.id)
              }
            console.log(params);
            axios.post('/api/v1/skills/' + state.item.id, params)
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
        axios.get('/api/v1/skills/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
      dispatch('fetchEnablingSkillsAll')
    },
    fetchEnablingSkillsAll({ commit }) {
        axios.get('/api/v1/enabling-skills')
          .then(response => {
          commit('setEnablingSkillsAll', response.data.data)
      })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
      setEnablingSkill({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'enabling_skill', { root: true });
        commit('setEnablingSkill', value)
      },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {

    setItem(state, item) {
        state.item = item
    },
  setEnablingSkill(state, value) {
    state.item.enabling_skill = value
  },
    setEnablingSkillsAll(state, value) {
        state.enablingSkillsAll = value
    },
    setTitle(state, value) {
        state.item.title = value
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
