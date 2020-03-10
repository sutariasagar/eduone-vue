function initialState() {
    return {
        item: {
            id: null,
            title: null,
            description: null,
            material_type: null,
            link: null,
            priority: null,
            mandatory: 'yes',
            credits: null,
            learning_material: null,
            upload_file: [],
            include_in_free_package:false,
        },
        learningmaterialsAll: [],
        materialtypesAll: [],
        //mandatoryEnum: [ { value: 'yes', label: 'Yes' }, { value: 'no', label: 'No' }, ],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    learningmaterialsAll: state => state.learningmaterialsAll,
    materialtypesAll: state => state.materialtypesAll,
    // mandatoryEnum: state => state.mandatoryEnum,
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
            // if (! _.isEmpty(state.item.mandatory) && typeof state.item.mandatory === 'object') {
            //     params.set('mandatory', state.item.mandatory.value)
            // }
            if (_.isEmpty(state.item.learning_material)) {
                params.set('learning_material_id', '')
            } else {
                params.set('learning_material_id', state.item.learning_material.id)
            }

            axios.post('/api/v1/learning-material-documents', params)
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
            // if (! _.isEmpty(state.item.mandatory) && typeof state.item.mandatory === 'object') {
            //     params.set('mandatory', state.item.mandatory.value)
            // }

            if (_.isEmpty(state.item.learning_material)) {
                params.set('learning_material_id', '')
            } else {
                params.set('learning_material_id', state.item.learning_material.id)
            }
            // if (_.isEmpty(state.item.material_type)) {
            //     params.set('material_type', '')
            // } else {
            //     params.set('material_type', state.item.material_type.id)
            // }

            axios.post('/api/v1/learning-material-documents/' + state.item.id, params)
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
        axios.get('/api/v1/learning-material-documents/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchLearningmaterialsAll')
        dispatch('fetchMaterialtypesAll')
    },
    fetchLearningmaterialsAll({ commit }) {
        axios.get('/api/v1/learning-materials')
            .then(response => {
                commit('setLearningmaterialsAll', response.data.data)
            })
    },
    fetchMaterialtypesAll({ commit }) {
        axios.get('/api/v1/material-types')
            .then(response => {
                commit('setMaterialtypesAll', response.data)
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

    setLink({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'link', { root: true });
        commit('setLink', value)
    },
    setPriority({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'priority', { root: true });
        commit('setPriority', value)
    },
    setMandatory({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'mandatory', { root: true });
        commit('setMandatory', value)
    },
    setFile({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'file', { root: true });
        commit('setFile', value)
    },
    destroyFile({ commit }, value) {
        commit('destroyFile', value)
    },
    destroyUploadedFile({ commit }, value) {
        commit('destroyUploadedFile', value)
    },
    setCredits({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'credits', { root: true });
        commit('setCredits', value)
    },
    setLearning_material({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'learning_material', { root: true });
        commit('setLearning_material', value)
    },
    setUpload_file({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'upload_file', { root: true });
        commit('setUpload_file', value)
    },
    setMaterial_type({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'material_type', { root: true });
        commit('setMaterial_type', value)
    },
    removeUploadFile({ commit, dispatch }, value) {
        commit('removeUploadFile', value);
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setIncludeInFreePackage({commit, dispatch}, value){
        commit('setIncludeInFreePackage', value);
    },
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
    setMaterial_type(state, value) {
        state.item.material_type = value
        console.log(state.item);
    },
    setLink(state, value) {
        state.item.link = value
    },
    setPriority(state, value) {
        state.item.priority = value
    },
    setMandatory(state, value) {
        state.item.mandatory = value
    },
    setFile(state, value) {
        for (let i in value) {
            let file = value[i];
            if (typeof file === "object") {
                state.item.file.push(file);
            }
        }
    },
    destroyFile(state, value) {
        for (let i in state.item.file) {
            if (i == value) {
                state.item.file.splice(i, 1);
            }
        }
    },
    destroyUploadedFile(state, value) {
        for (let i in state.item.uploaded_file) {
            let data = state.item.uploaded_file[i];
            if (data.id === value) {
                state.item.uploaded_file.splice(i, 1);
            }
        }
    },
    setCredits(state, value) {
        state.item.credits = value
    },
    setLearning_material(state, value) {
        state.item.learning_material = value
    },
    setLearningmaterialsAll(state, value) {
        state.learningmaterialsAll = value
    },
    setMaterialtypesAll(state, value) {
        state.materialtypesAll = value
    },
    setMandatoryEnum(state, value) {
        state.mandatoryEnum = value
    },
    setUpload_file(state, value) {
        if (state.item.upload_file)
            state.item.upload_file.push(value)
        else {
            state.item.upload_file = []
            state.item.upload_file.push(value)
        }

    },
    removeUploadFile(state, value) {
        console.log("here remove upload_file", value);
        for (let i in state.item.upload_file) {
            console.log(i, state.item.upload_file);
            let data = state.item.upload_file[i];
            console.log(data);
            if (data.id === value) {
                state.item.upload_file.splice(i, 1);
            }
        }

    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    setIncludeInFreePackage(state, value){
        state.item.include_in_free_package = value;
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
