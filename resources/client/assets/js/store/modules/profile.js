function initialState() {
    return {
        item: {
            id: null,
            name: null,
            email: null,
            password: null,
            role: [],
            profile_image: [],
            // file: [],
            // uploaded_file: [],
        },
        loading: false
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

            //params.set('uploaded_file', state.item.uploaded_file.map(o => o['id']))

            axios.post('api/v1/profile', params)
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
    setName({ commit }, value) {
        commit('setName', value)
    },
    setEmail({ commit }, value) {
        commit('setEmail', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setProfileImage({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'profile_image', { root: true });
        commit('setProfileImage', value)
    },
    // setFile({ commit, dispatch }, value) {
    //     dispatch('Alert/removeError', 'file', { root: true });
    //     commit('setFile', value)
    // },
    // destroyFile({ commit }, value) {
    //     commit('destroyFile', value)
    // },
    // destroyUploadedFile({ commit }, value) {
    //     commit('destroyUploadedFile', value)
    // },
    fetchData({ commit, dispatch }) {
        console.log("checking roles");
        axios.get('/api/v1/profile/')
            .then(response => {
                commit('setItem', response.data.data)
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
                    console.log(params);
                    console.log(fieldValue);
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
            console.log("checking parameters", params);
            axios.post('/api/v1/profile', params)
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
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setName(state, value) {
        state.item.name = value
    },
    setEmail(state, value) {
        state.item.email = value
    },
    setPassword(state, value) {
        state.item.password = value
    },
    setRole(state, value) {
        state.item.role = value
    },
    // setFile(state, value) {
    //     for (let i in value) {
    //         let file = value[i];
    //         if (typeof file === "object") {
    //             state.item.file.push(file);
    //         }
    //     }
    // },
    // destroyFile(state, value) {
    //     for (let i in state.item.file) {
    //         if (i == value) {
    //             state.item.file.splice(i, 1);
    //         }
    //     }
    // },
    // destroyUploadedFile(state, value) {
    //     for (let i in state.item.uploaded_file) {
    //         let data = state.item.uploaded_file[i];
    //         if (data.id === value) {
    //             state.item.uploaded_file.splice(i, 1);
    //         }
    //     }
    // },
    setProfileImage(state, value) {
        state.item.profile_image = value;
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
