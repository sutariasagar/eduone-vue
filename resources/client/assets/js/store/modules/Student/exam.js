/*
 * Copyright (c) 2019.
 */

import Vue from 'vue';

function initialState() {
    return {
        item: {
            id: null,
            questions: null
        },
        loading: true,
        question: null,
        lastQuestion: false,
        answer: null
    };
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    question: state => state.question,
    lastQuestion: state => state.lastQuestion,
    answer: state => state.answer
};

const actions = {
    startExam({ commit, dispatch }) {
        commit('resetState');
        commit('setLoading', true);
        return new Promise((resolve, reject) => {
            axios
                .get('/api/v1/start-exam/')
                .then(response => {
                    if (response.data.data.success) {
                        commit('setItem', response.data.data.exam);
                        dispatch('fetchQuestions', {
                            id: response.data.data.exam.id
                        });
                        resolve();
                    } else {
                        let message = response.data.data.message;
                        let errors = response.data.data.message;
                        dispatch(
                            'Alert/setAlert',
                            {
                                message: message,
                                errors: errors,
                                color: 'danger'
                            },
                            { root: true }
                        );
                        reject(response.data.data.message);
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    commit('setLoading', false);
                });
        });
    },
    fetchQuestions({ commit }, value) {
        axios.get('/api/v1/exams/questions/' + value.id).then(response => {
            commit('setQuestions', response.data.data);
        });
    },
    async saveAnswer({ state }) {
        console.log("yes we are in save answer");
        const answerObject = {
            exam_id: state.item.id,
            question_id: state.question.id,
            user_answer: state.answer
        };
        axios
            .post('/api/v1/answers/speaking', answerObject)
            .then(response => {
                console.log('Save Answer response: ', response.data);
            })
            .catch(error => {
                console.error(
                    'something went wrong while saving answer: ',
                    error
                );
            });
    },
    setLastQuestion({ commit }) {
        commit('setLastQuestion');
    },
    resetState({ commit }) {
        commit('resetState');
    },
    resetQuestionState({ commit }) {
        commit('resetQuestionState');
    },
    fetchSingleQuestion({ commit }, value) {
        commit('setSingleQuestion', value);
    },
    setAnswer({ commit }, value) {
        console.log('setAnswer action');
        commit('setAnswer', value);
    }
};

const mutations = {
    setItem(state, item) {
        console.log('checking item', item);
        state.item = item;
    },
    setLoading(state, loading) {
        state.loading = loading;
    },
    setQuestions(state, data) {
        state.item.questions = data;
    },
    setSingleQuestion(state, data) {
        console.log("chcking section", data.section);
        if (data.id == state.item.questions[data.section].length) {
            state.lastQuestion = true;
            state.question =
                state.item.questions[data.section][parseInt(data.id) - 1];
        } else {
          state.lastQuestion = false;
            state.question =
                state.item.questions[data.section][parseInt(data.id) - 1];
            console.log("question", state.question);
        }
        console.log("chcking question", state.lastQuestion);
    },
    resetState(state) {
        state = Object.assign(state, initialState());
    },
    setLastQuestion(state) {
        state.lastQuestion = false;
    },
    resetQuestionState(state) {
        state.question = null;
        state.answer = null;
    },
    setAnswer(state, value) {
        console.log('setAnswer mutation');
        Vue.set(state, 'answer', value);
        //console.log(state.answer);
    }
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
};
