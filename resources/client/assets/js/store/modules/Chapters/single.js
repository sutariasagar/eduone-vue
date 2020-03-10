function initialState() {
    return {
        item: {
            id: null,
            title: null,
            course: null,
            subject: null,
            learning_sequence: null,
        },
        coursesAll: [],
        subjectsAll: [],
        staticSubjectsAll: [],

        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAll: state => state.coursesAll,
    subjectsAll: state => state.subjectsAll,

}

const actions = {
    storeData({commit, state, dispatch}) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, {root: true})

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

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.subject)) {
                params.set('subject_id', '')
            } else {
                params.set('subject_id', state.item.subject.id)
            }

            axios.post('/api/v1/chapters', params)
                 .then(response => {
                     commit('resetState')
                     resolve()
                 })
                 .catch(error => {
                     let message = error.response.data.message || error.message
                     let errors = error.response.data.errors

                     dispatch(
                         'Alert/setAlert',
                         {message: message, errors: errors, color: 'danger'},
                         {root: true})

                     reject(error)
                 })
                 .finally(() => {
                     commit('setLoading', false)
                 })
        })
    },
    updateData({commit, state, dispatch}) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, {root: true})

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

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.subject)) {
                params.set('subject_id', '')
            } else {
                params.set('subject_id', state.item.subject.id)
            }

            axios.post('/api/v1/chapters/' + state.item.id, params)
                 .then(response => {
                     commit('setItem', response.data.data)
                     resolve()
                 })
                 .catch(error => {
                     let message = error.response.data.message || error.message
                     let errors = error.response.data.errors

                     dispatch(
                         'Alert/setAlert',
                         {message: message, errors: errors, color: 'danger'},
                         {root: true})

                     reject(error)
                 })
                 .finally(() => {
                     commit('setLoading', false)
                 })
        })
    },
    fetchData({commit, dispatch}, id) {
        axios.get('/api/v1/chapters/' + id)
             .then(response => {
                 commit('setItem', response.data.data)
             })

        dispatch('fetchCoursesAll')
        dispatch('fetchSubjectsAll')
    },
    fetchCoursesAll({commit}) {
        axios.get('/api/v1/courses')
             .then(response => {
                 commit('setCoursesAll', response.data.data)
             })
    },
    fetchSubjectsAll({commit}) {
        axios.get('/api/v1/subjects')
             .then(response => {
                 commit('setSubjectsAll', response.data.data)
             })
    },
    setTitle({ commit, dispatch}, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setCourse({ commit, dispatch}, value) {
        dispatch('Alert/removeError', 'course', { root: true });
        commit('setCourse', value);
        commit('filterSubjects', value);
    },
    setSubject({ commit, dispatch}, value) {
        dispatch('Alert/removeError', 'subject', { root: true });
        commit('setSubject', value)
    },
    setLearning_sequence({ commit, dispatch}, value) {
        dispatch('Alert/removeError', 'learning_sequence', { root: true });
        commit('setLearning_sequence', value)
    },
    resetState({commit}) {
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
    setCourse(state, value) {
        state.item.course = value;
        state.item.subject = null;
    },
    setSubject(state, value) {
        state.item.subject = value
    },
    setLearning_sequence(state, value) {
        state.item.learning_sequence = value
    },
    setCoursesAll(state, value) {
        state.coursesAll = value
    },

    setSubjectsAll(state, value) {
        state.subjectsAll = value
        state.staticSubjectsAll = value
    },
    filterSubjects(state, value){
        let filter = {};

        if (state.item.course) {
            filter.course_id = state.item.course.id;
        }
        state.subjectsAll =  _.filter(state.staticSubjectsAll, filter);
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
