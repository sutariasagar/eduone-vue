function initialState() {
    return {
        item: {

        },
        questionBanksAll: [],
        score: [],
        resultData: {},
        loading: false,

    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    questionBanksAll: state => state.questionBanksAll,
    resultData: state => state.resultData,

}

const actions = {
    fetchData({ commit, dispatch }, params) {
        console.log("here fetch data called", params);
        axios.get('/api/v1/exams/' + params.exam_id + '/students/' + params.id + '/review')
            .then(response => {
                console.log("in response");
                commit('setItem', response.data.data)
            })

        //dispatch('fetchQuestionBanksAll')

    },
    getResult({ commit}, params){
        console.log(params);
      axios.get('/api/v1/exams/' + params.exam_id + '/students/' + params.id + '/generateresult')
        .then(response => {
        console.log("in response");
      commit('setResult', response.data.data)
    })


      //dispatch('fetchQuestionBanksAll')
    },
    fetchQuestionBanksAll({ commit }) {
        axios.get('/api/v1/questions-banks')
            .then(response => {
                commit('setQuestionBanksAll', response.data.data)
            })
    },

    setScore({ commit }, score) {
        console.log("in setScore", score);
        let scoreString = JSON.stringify(score)
        let params = {};
        //commit('setScore', scoreString);
        params.score = scoreString
        if(score.status == 'submitted'){
          axios.post('/api/v1/answers/' + score.answer_id, params)
                .then(response => {
                console.log("in setScore then", response.data);
              //commit('setScore', response.data.data)
            });
        }else{
              axios.post('/api/v1/saveanswersasdraft/' + score.answer_id, params)
                .then(response => {
                console.log("in setScore then", response.data);
              //commit('setScore', response.data.data)
            });
        }

    },
    resetState({ commit }) {
        commit('resetState')
    },

}

const mutations = {
    setItem(state, item) {
        console.log('checking item', item)
        state.item = item
    },
      setResult(state, value) {
        console.log("checking here in resutl");
        state.resultData = value
      },
    setQuestionBanksAll(state, value) {
        state.questionBanksAll = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setScore(state, value) {
        console.log("in mutation set score");
        state.score.push(value);
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
