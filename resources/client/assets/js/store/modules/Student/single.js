function initialState() {
    return {
        item: {
        },
        coursesAndChapters: [],
        coursesAndChaptersSeen: [],
        coursesAndChaptersNotSeen: [],

        coursesAndChaptersCount: 0,
        coursesAndChaptersSeenCount: 0,
        coursesAndChaptersNotSeenCount: 0,

        coursesAndChaptersDocuments: [],
        coursesAndChaptersDocumentsSeen: [],
        coursesAndChaptersDocumentsNotSeen: [],
        coursesAndChaptersDocumentsCount: 0,
        coursesAndChaptersDocumentsSeenCount: 0,
        coursesAndChaptersDocumentsNotSeenCount: 0,        
        
        coursesAndChaptersPracticeQuestions: [],

        practiceQuestionsCount : 0,
        practiceQuestionsPendingCount: 0,
        practiceQuestionsPracticedCount: 0,

        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    coursesAndChapters: state => state.coursesAndChapters,
    coursesAndChaptersSeen: state => state.coursesAndChaptersSeen,
    coursesAndChaptersNotSeen: state => state.coursesAndChaptersNotSeen,
    coursesAndChaptersCount: state => state.coursesAndChaptersCount,
    coursesAndChaptersSeenCount: state => state.coursesAndChaptersSeenCount,
    coursesAndChaptersNotSeenCount: state => state.coursesAndChaptersNotSeenCount,
    coursesAndChaptersDocuments: state => state.coursesAndChaptersDocuments,
    coursesAndChaptersDocumentsSeen: state => state.coursesAndChaptersDocumentsSeen,
    coursesAndChaptersDocumentsNotSeen: state => state.coursesAndChaptersDocumentsNotSeen,
    coursesAndChaptersDocumentsCount: state => state.coursesAndChaptersDocumentsCount,
    coursesAndChaptersDocumentsSeenCount: state => state.coursesAndChaptersDocumentsSeenCount,
    coursesAndChaptersDocumentsNotSeenCount: state => state.coursesAndChaptersDocumentsNotSeenCount,
    coursesAndChaptersPracticeQuestions: state => state.coursesAndChaptersPracticeQuestions,
    practiceQuestionsCount : state => state.practiceQuestionsCount,
    practiceQuestionsPendingCount: state => state.practiceQuestionsPendingCount,
    practiceQuestionsPracticedCount: state => state.practiceQuestionsPracticedCount,

}

const actions = {

    fetchCoursesAndChapters({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/')
            .then(response => {
                commit('setCoursesAndChapters', response.data.data)
            })
        //dispatch('fetchPackagesAll')
    },
    fetchCoursesAndChaptersSeen({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/seen')
            .then(response => {
                commit('setCoursesAndChaptersSeen', response.data.data)
            })
        //dispatch('fetchPackagesAll')
    },
    fetchCoursesAndChaptersNotSeen({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/notseen')
            .then(response => {
                commit('setCoursesAndChaptersNotSeen', response.data.data)
            })
        //dispatch('fetchPackagesAll')
    },

    fetchCoursesAndChaptersCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/count')
            .then(response => {
                commit('setCoursesAndChaptersCount', response.data.data.count)
            })
        //dispatch('fetchPackagesAll')
    },
    fetchCoursesAndChaptersSeenCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/seen/count')
            .then(response => {
                commit('setCoursesAndChaptersSeenCount', response.data.data.count)
            })
        //dispatch('fetchPackagesAll')
    },
    fetchCoursesAndChaptersNotSeenCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapters/notseen/count')
            .then(response => {
                commit('setCoursesAndChaptersNotSeenCount', response.data.data.count)
            })
        //dispatch('fetchPackagesAll')
    },
    fetchLearningVideos({ commit, dispatch }, data) {
        axios.get('/api/v1/chapterwisevideos/subject/' + data.subjectId + '/chapter/' + data.chapterId)
            .then(response => {
                commit('setVideos', response.data.data)
            })
    },
    fetchCoursesAndChaptersDocuments({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/')
            .then(response => {
                commit('setCoursesAndChaptersDocuments', response.data.data)
            })
    },
    fetchCoursesAndChaptersDocumentsSeen({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/seen')
            .then(response => {
                commit('setCoursesAndChaptersDocumentsSeen', response.data.data)
            })
    },
    fetchCoursesAndChaptersDocumentsNotSeen({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/notseen')
            .then(response => {
                commit('setCoursesAndChaptersDocumentsNotSeen', response.data.data)
            })
    },

    fetchCoursesAndChaptersDocumentsCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/count')
            .then(response => {
                commit('setCoursesAndChaptersDocumentsCount', response.data.data.count)
            })
    },
    fetchCoursesAndChaptersDocumentsSeenCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/seen/count')
            .then(response => {
                commit('setCoursesAndChaptersDocumentsSeenCount', response.data.data.count)
            })
    },
    fetchCoursesAndChaptersDocumentsNotSeenCount({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchaptersdocuments/notseen/count')
            .then(response => {
                commit('setCoursesAndChaptersDocumentsNotSeenCount', response.data.data.count)
            })
    },

    fetchCoursesAndChaptersPracticeQuestions({ commit, dispatch }) {
        axios.get('/api/v1/coursesandchapterspracticequestions/')
            .then(response => {
                commit('setCoursesAndChaptersPracticeQuestions', response.data.data)
            })
    },
    setPlayedDocument({commit, dispatch}, value){
        console.log("hcekcing");    
        commit('setLoading', true)
        
        return new Promise((resolve, reject) => {
            let params = new FormData();            
            params.set('learning_material_document_id', value);                                  
            axios.post('/api/v1/updatedocumentsused', params)
                .then(response => {                    
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
    fetchPracticeQuestionsCount({ commit, dispatch }) {
        axios.get('/api/v1/practicequestions/count')
            .then(response => {
                commit('setPracticeQuestionsCount', response.data.data.count)
            })
    },
    fetchPracticeQuestionsPendingCount({ commit, dispatch }) {
        axios.get('/api/v1/practicequestions/notseen/count')
            .then(response => {
                commit('setPracticeQuestionsNotSeenCount', response.data.data.count)
            })
    },
    fetchPracticeQuestionsPracticedCount({ commit, dispatch }) {
        axios.get('/api/v1/practicequestions/seen/count')
            .then(response => {
                commit('setPracticeQuestionsSeenCount', response.data.data.count)
            })
    },
}

const mutations = {
    setCoursesAndChapters(state, value) {
        state.coursesAndChapters = value
    },
    setCoursesAndChaptersSeen(state, value) {
        state.coursesAndChaptersSeen = value
    },
    setCoursesAndChaptersNotSeen(state, value) {
        state.coursesAndChaptersNotSeen = value
    },

    setCoursesAndChaptersCount(state, value) {
        state.coursesAndChaptersCount = value
    },
    setCoursesAndChaptersSeenCount(state, value) {
        state.coursesAndChaptersSeenCount = value
    },
    setCoursesAndChaptersNotSeenCount(state, value) {
        state.coursesAndChaptersNotSeenCount = value
    },

    setCoursesAndChaptersDocuments(state, value) {
        state.coursesAndChaptersDocuments = value
    },
    setCoursesAndChaptersDocumentsSeen(state, value) {
        state.coursesAndChaptersDocumentsSeen = value
    },
    setCoursesAndChaptersDocumentsNotSeen(state, value) {
        state.coursesAndChaptersDocumentsNotSeen = value
    },

    setCoursesAndChaptersDocumentsCount(state, value) {
        state.coursesAndChaptersDocumentsCount = value
    },
    setCoursesAndChaptersDocumentsSeenCount(state, value) {
        state.coursesAndChaptersDocumentsSeenCount = value
    },
    setCoursesAndChaptersDocumentsNotSeenCount(state, value) {
        state.coursesAndChaptersDocumentsNotSeenCount = value
    },
    setCoursesAndChaptersPracticeQuestions(state, value) {
        state.coursesAndChaptersPracticeQuestions = value;
    },
    setVideos(state, value) {
        console.log(value);
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    setLoading(state, value){
        state.loading = value;
    },
    setPracticeQuestionsSeenCount( state, value){
        state.practiceQuestionsPracticedCount  = value;
    },
    setPracticeQuestionsNotSeenCount(state, value){
        state.practiceQuestionsPendingCount = value;
    },
    setPracticeQuestionsCount(state, value){
        state.practiceQuestionsCount = value;
    }

}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
