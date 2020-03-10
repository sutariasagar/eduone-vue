function initialState() {
    return {
        item: {
            id: null,
            title: null,
            configurations: [
                {
                    key: "html_text",
                    title: "HTML Text",
                    chosen: true,
                    icon: "fa fa-html5"
                },
                {
                    key: "image_upload",
                    title: "Image Upload",
                    chosen: false,
                    icon: "fa fa-picture-o"
                },
                {
                    key: "audio_upload",
                    title: "Audio Upload",
                    chosen: false,
                    icon: "fa fa-headphones"
                },
                {
                    key: "youtube_video",
                    title: "Youtube Video",
                    chosen: false,
                    icon: "fa fa-youtube-play"
                },
                {
                    key: "ordered_text",
                    title: "Ordered Texts",
                    chosen: false,
                    icon: "fa fa-text-height"
                },
                {
                    key: "ordered_images",
                    title: "Ordered Images",
                    chosen: false,
                    icon: "fa fa-file-image-o"
                },
                {
                    key: "fib_no_options",
                    title: "Fill in the blank - without option",
                    chosen: false,
                    isFib: true,
                    icon: "fa fa-text-width"
                },
                {
                    key: "fib_dropdown",
                    title: "Fill in the blank - With Dropdown options",
                    chosen: false,
                    isFib: true,
                    icon: "fa fa-list"
                },
                {
                    key: "fib_drag_drop",
                    title: "Fill in the blank - With drag & drop",
                    chosen: false,
                    isFib: true,
                    icon: "fa fa-arrows"
                },
                {
                    key: "mcq_single_option",
                    title: "Multiple Choice Questions - Single Option",
                    chosen: false,
                    icon: "fa fa-check-circle"
                },
                {
                    key: "mcq_multiple_option",
                    title: "Multiple Choice Questions - Multiple Option",
                    chosen: false,
                    icon: "fa fa-check"
                },
                {
                    key: "select_text",
                    title: "Select Text from screen - Multiple Option",
                    chosen: false,
                    icon: "fa fa-pencil"
                }
            ],
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
                if (fieldName == "configurations") {
                    params.set(fieldName, JSON.stringify(fieldValue));
                } else if (typeof fieldValue !== 'object') {
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


            axios.post('/api/v1/answers-types', params)
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
                if (fieldName == "configurations") {
                    params.set(fieldName, JSON.stringify(fieldValue));
                } else if (typeof fieldValue !== 'object') {
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


            axios.post('/api/v1/answers-types/' + state.item.id, params)
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
        axios.get('/api/v1/answers-types/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setConfigurations({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'configurations', { root: true });
        commit('setConfigurations', value)
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
    setConfigurations(state, value) {
        state.item.configurations = value
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
