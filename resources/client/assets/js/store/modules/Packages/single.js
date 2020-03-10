function initialState() {
    return {
        item: {
            id: null,
            title: null,
            price: null,
            status: null,
            tests_with_assessment: null,
            video_tutorials: null,
            practice_questions: null,
            mock_tests: null,
            testcenter_mocktests: null,
            pte_vouchers: null,
            webinar_sessions: null,
            personal_feedback_and_assessment: null,
            coaching_session_daily: null,
            unique_package_name: null
        },
        statusEnum: [{ value: 'active', label: 'Active' }, { value: 'inactive', label: 'Inactive' },],
        personal_feedback_and_assessmentEnum: [{ value: 'true', label: 'True' }, { value: 'false', label: 'False' },],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    statusEnum: state => state.statusEnum,
    personal_feedback_and_assessmentEnum: state => state.personal_feedback_and_assessmentEnum
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

            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            if (!_.isEmpty(state.item.personal_feedback_and_assessment) && typeof state.item.personal_feedback_and_assessment === 'object') {
                params.set('personal_feedback_and_assessment', state.item.personal_feedback_and_assessment.value)
            }

            axios.post('/api/v1/packages', params)
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

            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            if (!_.isEmpty(state.item.personal_feedback_and_assessment) && typeof state.item.personal_feedback_and_assessment === 'object') {
                params.set('personal_feedback_and_assessment', state.item.personal_feedback_and_assessment.value)
            }

            axios.post('/api/v1/packages/' + state.item.id, params)
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
        axios.get('/api/v1/packages/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setPrice({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'price', { root: true });
        commit('setPrice', value)
    },
    setStatus({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'status', { root: true });
        commit('setStatus', value)
    },
    setTests_with_assessment({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'tests_with_assessment', { root: true });
        commit('setTests_with_assessment', value)
    },
    setTestcenter_mocktests({commit, dispatch}, value){
        dispatch('Alert/removeError', 'testcenter_mocktests', { root: true });
        commit('setTestcenter_mocktests', value)
    },
    setVideo_tutorials({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'video_tutorials', { root: true });
        commit('setVideo_tutorials', value)
    },
    setPractice_questions({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'practice_questions', { root: true });
        commit('setPractice_questions', value)
    },
    setMock_tests({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'mock_tests', { root: true });
        commit('setMock_tests', value)
    },
    setPte_vouchers({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'pte_vouchers', { root: true });
        commit('setPte_vouchers', value)
    },
    setWebinar_sessions({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'webinar_sessions', { root: true });
        commit('setWebinar_sessions', value)
    },
    setPersonal_feedback_and_assessment({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'personal_feedback_and_assessment', { root: true });
        commit('setPersonal_feedback_and_assessment', value)
    },
    setCoaching_session_daily({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'coaching_session_daily', { root: true });
        commit('setCoaching_session_daily', value)
    },
    setUnique_package_name({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'unique_package_name', { root: true });
        commit('setUnique_package_name', value)
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
    
    setPrice(state, value) {
        state.item.price = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setTests_with_assessment(state, value) {
        state.item.tests_with_assessment = value
    },
    setVideo_tutorials(state, value) {
        state.item.video_tutorials = value
    }, 
    setPractice_questions(state, value) {
        state.item.practice_questions = value
    },
    setMock_tests(state, value) {
        state.item.mock_tests = value
    },
    setPte_vouchers(state, value) {
        state.item.pte_vouchers = value
    },
    setWebinar_sessions(state, value) {
        state.item.webinar_sessions = value
    },
    setPersonal_feedback_and_assessment(state, value) {
        state.item.personal_feedback_and_assessment = value
    },
    setCoaching_session_daily(state, value) {
        state.item.coaching_session_daily = value
    },
    setUnique_package_name(state, value) {
        state.item.unique_package_name = value
    },
    setTestcenter_mocktests(state, value){
        state.item.testcenter_mocktests = value
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
