function initialState() {
    return {
        item: {
            id: null,
            title: null,
            course: null,
            question_pool: null,
            total_marks: null,
            passing_marks: null,
            duration_min: null,
            duration_max: null,
            status: 'active',
            start_instructions: null,
            end_instructions: null,
            exam_type: null,
            sections_count: null,
            can_see_solution: false,
            instruction_type: null,
            created_by: null,
            updated_by: null,
            question_set: null,
        },
        coursesAll: [],
        questionSetsAll: [],
        question_poolEnum: [{ value: 'random', label: 'Random' }, { value: 'static', label: 'Static' },],
        statusEnum: [{ value: 'active', label: 'Active' }, { value: 'inactive', label: 'Inactive' },],
        exam_typeEnum: [{ value: 'pte_simulation', label: 'PTE Simulation' }, { value: 'scored_free', label: 'Scored Free' },
        { value: 'unscored_free', label: 'Unscored Free' }, { value: 'proctored_online', label: 'Proctored Online' },],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAll: state => state.coursesAll,
    questionSetsAll: state => state.questionSetsAll,
    question_poolEnum: state => state.question_poolEnum,
    statusEnum: state => state.statusEnum,
    exam_typeEnum: state => state.exam_typeEnum,
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

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.question_set)) {
                params.set('question_set_id', null)
            } else {
                params.set('question_set_id', state.item.question_set.id)
            }
            if (!_.isEmpty(state.item.question_pool) && typeof state.item.question_pool === 'object') {
                params.set('question_pool', state.item.question_pool.value)
            }
            if (!_.isEmpty(state.item.exam_type) && typeof state.item.exam_type === 'object') {
                params.set('exam_type', state.item.exam_type.value)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            params.set('can_see_solution', state.item.can_see_solution ? 1 : 0)

            axios.post('/api/v1/exams', params)
                .then(response => {
                    //commit('resetState')
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors
                    let module = 'exam'
                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger', module: 'exam' },
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

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.question_set)) {
                params.set('question_set_id', null)
            } else {
                params.set('question_set_id', state.item.question_set.id)
            }
            if (!_.isEmpty(state.item.question_pool) && typeof state.item.question_pool === 'object') {
                params.set('question_pool', state.item.question_pool.value)
            }
            if (!_.isEmpty(state.item.exam_type) && typeof state.item.exam_type === 'object') {
                params.set('exam_type', state.item.exam_type.value)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            params.set('can_see_solution', state.item.can_see_solution ? 1 : 0)

            axios.post('/api/v1/exams/' + state.item.id, params)
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
    cloneData({ commit, state, dispatch }) {
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

            if (_.isEmpty(state.item.course)) {
                params.set('course_id', '')
            } else {
                params.set('course_id', state.item.course.id)
            }
            if (_.isEmpty(state.item.question_set)) {
                params.set('question_set_id', null)
            } else {
                params.set('question_set_id', state.item.question_set.id)
            }
            if (!_.isEmpty(state.item.question_pool) && typeof state.item.question_pool === 'object') {
                params.set('question_pool', state.item.question_pool.value)
            }
            if (!_.isEmpty(state.item.exam_type) && typeof state.item.exam_type === 'object') {
                params.set('exam_type', state.item.exam_type.value)
            }
            if (!_.isEmpty(state.item.status) && typeof state.item.status === 'object') {
                params.set('status', state.item.status.value)
            }
            params.set('can_see_solution', state.item.can_see_solution ? 1 : 0)

            axios.post('/api/v1/exams', params)
                .then(response => {
                    //commit('resetState')
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors
                    let module = 'exam'
                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger', module: 'exam' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        axios.get('/api/v1/exams/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCoursesAll')
        dispatch('fetchQuestionSetsAll')
    },
    fetchCoursesAll({ commit }) {
        axios.get('/api/v1/courses')
            .then(response => {
                commit('setCoursesAll', response.data.data)
            })
    },
    fetchQuestionSetsAll({ commit }) {
        axios.get('/api/v1/question-sets')
            .then(response => {
            commit('setQuestionSetsAll', response.data.data)
    })
    },
    setTitle({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'title', { root: true });
        commit('setTitle', value)
    },
    setCourse({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'course', { root: true });
        commit('setCourse', value)
    },
    setQuestionSet({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'question_set', { root: true });
        commit('setQuestionSet', value)
    },
    setQuestion_pool({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'question_pool', { root: true });
        commit('setQuestion_pool', value)
    },
    setTotal_marks({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'total_marks', { root: true });
        commit('setTotal_marks', value)
    },
    setPassing_marks({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'passing_marks', { root: true });
        commit('setPassing_marks', value)
    },
    setDurationMin({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'duration_min', { root: true });
        commit('setDurationMin', value)
    },
    setDurationMax({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'duration_max', { root: true });
        commit('setDurationMax', value)
    },
    setStatus({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'status', { root: true });
        commit('setStatus', value)
    },
    setStart_instructions({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'start_instruction', { root: true });
        commit('setStart_instructions', value)
    },
    setEnd_instructions({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'end_instruction', { root: true });
        commit('setEnd_instructions', value)
    },
    setExam_type({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'exam_type', { root: true });
        commit('setExam_type', value)
    },
    setSections_count({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'sections_count', { root: true });
        commit('setSections_count', value)
    },
    setCan_see_solution({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'can_see_solution', { root: true });
        commit('setCan_see_solution', value)
    },
    setInstruction_type({ commit, dispatch }, value) {
        dispatch('Alert/removeError', 'instruction_type', { root: true });
        commit('setInstruction_type', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
    resetSubjectChapterForm({ commit,dispatch }, value){
        dispatch('ExamSectionSubjectMappingsSingle/resetFormState',{}, { root: true });
    },
    setSubjectChapterFormData({commit, dispatch}, value){
        dispatch('ExamSectionSubjectMappingsSingle/fetchData',value, { root: true });
    }

}

const mutations = {
    setItem(state, item) {
        console.log('checking item', item)
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setCourse(state, value) {
        state.item.course = value
        state.item.subject = null
        state.item.chapter = null
        state.item.topic = null
    },
    setQuestionSet(state, value) {
        state.item.question_set = value
    },
    setQuestion_pool(state, value) {
        state.item.question_pool = value
    },
    setTotal_marks(state, value) {
        state.item.total_marks = value
    },
    setPassing_marks(state, value) {
        state.item.passing_marks = value
    },
    setDurationMin(state, value) {
        state.item.duration_min = value
    },
    setDurationMax(state, value) {
        state.item.duration_max = value
    },
    setStatus(state, value) {
        state.item.status = value
    },
    setStart_instructions(state, value) {
        state.item.start_instructions = value
    },
    setEnd_instructions(state, value) {
        state.item.end_instructions = value
    },
    setExam_type(state, value) {
        state.item.exam_type = value
    },
    setSections_count(state, value) {
        state.item.sections_count = value
    },
    setCan_see_solution(state, value) {
        state.item.can_see_solution = value
    },
    setInstruction_type(state, value) {
        state.item.instruction_type = value
    },
    setQuestion_poolEnum(state, value) {
        state.question_poolEnum = value
    },
    setStatusEnum(state, value) {
        state.statusEnum = value
    },
    setExam_typeEnum(state, value) {
        state.exam_typeEnum = value
    },
    setCoursesAll(state, value) {
        state.coursesAll = value
    },
    setQuestionSetsAll(state, value) {
        state.questionSetsAll = value
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
