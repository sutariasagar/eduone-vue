function initialState() {
    return {
        item: {
            id: null,
            name: null,
            password: null,
            registration_id: null,
            test_taker_id: null,
            first_name: null,
            middle_name: null,
            last_name: null,
            email: null,
            phone: null,
            date_of_birth: null,
            gender: null,
            country: null,
            state: null,
            city: null,
            terminal: null,
            type: 'student',
            package: null,
            student_image: [],
            resetStudentPassword: null,
            capture_image: []
        },
        packagesAll: [],
        loading: false,
        password: null,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    packagesAll: state => state.packagesAll,
    password: state => state.password
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

            if (_.isEmpty(state.item.package)) {
                params.set('package_id', '')
            } else {
                params.set('package_id', state.item.package.id)
            }
            params.set('type', 'student');

            params.set('name', state.item.first_name + " " + state.item.middle_name + " " + state.item.last_name);


            axios.post('/api/v1/students', params)
                .then(response => {
                    console.log('response', response.data);
                    commit('setPassword', response.data.data.randompassword);
                    commit('setTerminal', response.data.data.terminal);
                    //commit('resetState')
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

            if (_.isEmpty(state.item.package)) {
                params.set('package_id', '')
            } else {
                params.set('package_id', state.item.package.id)
            }
            params.set('type', 'student');

            params.set('name', state.item.first_name + " " + state.item.middle_name + " " + state.item.last_name);

            axios.post('/api/v1/students/' + state.item.id, params)
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
        axios.get('/api/v1/students/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchPackagesAll')
    },
    fetchPackagesAll({ commit }) {
        axios.get('/api/v1/packages')
            .then(response => {
                commit('setPackagesAll', response.data.data)
            })
    },
    getCredential({ commit }, id) {
        console.log("in get credential", id);
        axios.get('/api/v1/students/getcredentials/' + id)
            .then(response => {
                console.log("get credential", response.data);
                commit('setCredential', response.data.data);
                commit('setTerminal', response.data.data.terminal);
            })
    },
    resetStudentPassword({ commit, state }){
        console.log("in reset password");
        return new Promise((resolve, reject) => {
        let params = new FormData();
            params.set('_method', 'PUT')
            params.set('newpassword', state.item.reset_password);
            params.set('id', state.item.id);
        
        axios.post('/api/v1/students/reset-password', params)
            .then(response => {
                console.log("password change request call");
                commit('setStudentPassword', response.data.data);
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
        })
    },
    setRegistration_id({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'registration_id', { root: true });
        commit('setRegistration_id', value)
    },
    setTest_taker_id({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'test_taker_id', { root: true });
        commit('setTest_taker_id', value)
    },
    setFirst_name({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'first_name', { root: true });
        commit('setFirst_name', value)
    },
    setMiddle_name({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'middle_name', { root: true });
        commit('setMiddle_name', value)
    },
    setLast_name({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'last_name', { root: true });
        commit('setLast_name', value)
    },
    setEmail({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'email', { root: true });
        commit('setEmail', value)
    },
    setPhone({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'phone', { root: true });
        commit('setPhone', value)
    },
    setDate_of_birth({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'date_of_birth', { root: true });
        commit('setDate_of_birth', value)
    },
    setGender({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'gender', { root: true });
        commit('setGender', value)
    },
    setCountry({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'country', { root: true });
        commit('setCountry', value)
    },
    setState({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'state', { root: true });
        commit('setState', value)
    },
    setCity({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'city', { root: true });
        commit('setCity', value)
    },
    setType({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'type', { root: true });
        commit('setType', value)
    },
    setPackage({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'package', { root: true });
        commit('setPackage', value)
    },
    setStudentImage({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'student_image', { root: true });
        commit('setStudentImage', value)
    },
    setCaptureImage({ commit, dispatch }, value) {
        console.log("here action call");
        dispatch('Alert/removeError', 'capture_image', { root: true });
        commit('setCaptureImage', value)
    },
    setStudentPassword({commit, dispatch}, value){
         console.log("here change password action call");
         dispatch('Alert/removeError', 'reset_password', { root: true });
         commit('setStudentPassword', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setRegistration_id(state, value) {
        state.item.registration_id = value
    },
    setTest_taker_id(state, value) {
        state.item.test_taker_id = value
    },
    setFirst_name(state, value) {
        state.item.first_name = value
    },
    setMiddle_name(state, value) {
        state.item.middle_name = value
    },
    setLast_name(state, value) {
        state.item.last_name = value
    },
    setEmail(state, value) {
        state.item.email = value
    },
    setPhone(state, value) {
        state.item.phone = value
    },
    setDate_of_birth(state, value) {
        state.item.date_of_birth = value
    },
    setGender(state, value) {
        state.item.gender = value
    },
    setCountry(state, value) {
        state.item.country = value
    },
    setState(state, value) {
        state.item.state = value
    },
    setCity(state, value) {
        state.item.city = value
    },
    setType(state, value) {
        state.item.type = value
    },
    setPackage(state, value) {
        state.item.package = value
    },
    setPackagesAll(state, value) {
        state.packagesAll = value
    },
    setPassword(state, value) {
        state.password = value
    },
    setTerminal(state, value) {
        console.log("here in mutaion,", value);
        state.item.terminal = value
    },
    setCredential(state, value) {
        state.password = value.randompassword
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setStudentImage(state, value) {
        state.item.student_image = value;
    },
    setCaptureImage(state, value) {
        console.log("here mutation call");
        state.item.capture_image = value;
    },
    setStudentPassword(state, value){
        console.log("change password here");
        state.item.reset_password = value;
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
