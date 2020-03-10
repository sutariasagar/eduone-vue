function initialState() {
    return {
        
        message: null,
        errors: null,
        color: 'success',
        module: null,
    }
}

const getters = {
    message: state => state.message,
    errors: state => state.errors,
    module: state => state.module,
    color: state => state.color
}

const actions = {
    setMessage({ commit }, message) {
        commit('setMessage', message)
    },
    setErrors({ commit }, errors) {
        commit('setErrors', errors)
    },
    setColor({ commit }, color) {
        commit('setColor', color)
    },
    setModule({ commit }, module) {
        commit('setModule', module)
    },
    setAlert({ commit }, data) {
        commit('setMessage', data.message || null)
        commit('setErrors', data.errors || null)
        commit('setColor', data.color || null)
        commit('setModule', data.module || null)
    },
    removeError({ commit }, error) {
        commit('removeError', error);
    },
    resetState({ commit }) {
        //console.log("hcecking reset");
        commit('resetState')
    }
}

const mutations = {
    setMessage(state, message) {
        state.message = message
    },
    setErrors(state, errors) {
        state.errors = errors
    },
    setModule(state, module) {
        state.module = module
    },
    removeError(state, error) {
        //console.log(error);
        // console.log(state.errors);
        if (state.errors && state.errors.hasOwnProperty(error)) {
            delete state.errors[error]
        }
        //console.log(state.errors);
    },
    setColor(state, color) {
        state.color = color || 'success'
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
