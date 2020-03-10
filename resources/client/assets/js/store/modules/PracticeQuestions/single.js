function initialState() {
    return {
        item: {
            subject: null,
            chapter: null,
            level: null
        },
        questions: [],
        question:[],
        loading: false,
        subjectsAll: [],
        chaptersAll: [],
        levelsAll: [
            {title:'Easy',value:'easy'},
            {title:'Medium',value:'medium'},
            {title:'Difficult',value:'difficult'},
        ],
        staticChaptersAll: [],
        staticSubjectsAll: [],
        answer: null
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    questions: state => state.questions,
    question: state => state.question,
    subjectsAll: state => state.subjectsAll,
    chaptersAll: state => state.chaptersAll,
    levelsAll: state => state.levelsAll,
    answer: state => state.answer
}

const actions = {
    fetchData({ commit, dispatch }, value) {
        return new Promise((resolve, reject) => {
        axios.get('/api/v1/fetchpracticequestions/' + value.subject+'/'+value.chapter+'/'+value.level.value)
            .then(response => {
                commit('setQuestions', response.data.data)
                resolve()
            })
        });
    },
    fetchSubjectsAll({commit}) {
        axios.get('/api/v1/subjects')
             .then(response => {
                 commit('setSubjectsAll', response.data.data)
             })
    },
    fetchChaptersAll({commit}) {
        axios.get('/api/v1/chapters')
             .then(response => {
                 commit('setChaptersAll', response.data.data)
             })
    },

    setSubject({ commit,dispatch }, value) {
        dispatch('Alert/removeError', 'subject', { root: true });
        commit('setSubject', value)
        commit('filterChapters', value);
    },
    setLevel({ commit,dispatch }, value) {
        dispatch('Alert/removeError', 'level', { root: true });
        commit('setLevel', value)
    },
    setChapter({ commit,dispatch }, value) {
        dispatch('Alert/removeError', 'chapter', { root: true });
        commit('setChapter', value)
    },
    resetState({ commit }) {
        commit('resetState')
    },
    setQuestion({commit}, value){
        commit('setQuestion', value);
    },
    fetchQuestion({commit}, value){
        return new Promise((resolve, reject) => {
            axios.get('/api/v1/fetchsinglepracticequestions/' + value)
                .then(response => {
                    commit('setSingleQuestion', response.data.data)
                    resolve()
                })
            });
    },
    setAnswer({ commit }, value) {
        //console.log('setAnswer action');
        commit('setAnswer', value);
    },
    async saveAnswer({ state }) {
        //console.log("yes we are in save answer");
        const answerObject = {
            question_id: state.question.id,
            user_answer: state.answer
        };
        axios
            .post('/api/v1/practiceanswers', answerObject)
            .then(response => {
                //console.log('Save Answer response: ', response.data);
            })
            .catch(error => {
                console.error(
                    'something went wrong while saving answer: ',
                    error
                );
            });
    },
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setSubject(state, value) {
        state.item.subject = value
        state.item.chapter = null
    },
    setChapter(state, value) {
        state.item.chapter = value
    },
    setLevel(state, value) {
        state.item.level = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setQuestions(state, value){
        state.questions = value;
    },
    filterSubjects(state, value){
        let filter = {};

        state.subjectsAll =  _.filter(state.staticSubjectsAll, filter);
    },
    filterChapters(state, value){
        let filter = {};

        if (state.item.subject) {
            filter.subject_id = state.item.subject.id;
        }
        state.chaptersAll =  _.filter(state.staticChaptersAll, filter);
    },
    setQuestion(state, value){
        //console.log("checking questions",value);
        state.question = state.questions[value];
    },
    setSingleQuestion(state, value){
        state.question = value;
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    setSubjectsAll(state, value) {
        state.subjectsAll = value
        state.staticSubjectsAll = value
    },
    setChaptersAll(state, value) {
        state.chaptersAll = value
        state.staticChaptersAll = value
    },
    setAnswer(state, value) {
        //console.log('setAnswer mutation');
        Vue.set(state, 'answer', value);
        //console.log(state.answer);
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
