function initialState() {
    return {
        item: {
            id: null,
            title: null,
            section: null,
            selectedQuestions: {}
        },
        loading: false,
        sectionsAll: [],
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    sectionsAll: state => state.sectionsAll,
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
                    if (fieldValue && typeof fieldValue == 'object') {
                        params.set(fieldName, JSON.stringify(fieldValue));
                    }
                    else if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            axios.post('/api/v1/question-sets', params)
                .then(response => {
                    dispatch('resetState')
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
                    if (fieldValue && typeof fieldValue == 'object') {
                        params.set(fieldName, JSON.stringify(fieldValue));
                    }
                    else if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }            
            axios.post('/api/v1/question-sets/' + state.item.id, params)
                .then(response => {
                    //commit('setItem', response.data.data)
                    commit('resetState');
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
        axios.get('/api/v1/question-sets/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
        dispatch('fetchSectionsAll')
    },
    fetchSectionsAll({ commit }) {
        axios.get('/api/v1/sections')
            .then(response => {
            commit('setSectionsAll', response.data)
    })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setSelectedQuestions({commit, dispatch}, value){        
        dispatch('Alert/removeError', 'selectedQuestions', { root: true });
        commit('setSelectedQuestions', value)
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setSectionsAll(state, value) {
        state.sectionsAll = value
    },
    resetState(state) {
        console.log("yes we are calling reset state");
        state = Object.assign(state, initialState())
    },
    setSelectedQuestions(state, selectedQuestions){
        let section = selectedQuestions.section;
        state.item.selectedQuestions[section] = [];
        selectedQuestions.id.forEach(element => {            
            if(state.item.selectedQuestions[section].includes(parseInt(element))){

            }else{                
                state.item.selectedQuestions[section].push(parseInt(element));                
            }
        });
        //state.item.selectedQuestions[selectedQuestions.section].push(selectedQuestions);        
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
