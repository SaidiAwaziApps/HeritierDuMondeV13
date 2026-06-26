import { createStore } from "vuex";



const feedbackStore = createStore({
    state: () => {
        return {
            feedback: {
                title: '',
                active: false,
                response: null,
                error: null
            }
        }
    },
    mutations: {
        setTitle: (state,value) => {
            state.feedback.title = value;  
        },
        setActive: (state,value) => {
            state.feedback.active = value;  
        },
        setResponse: (state,value) => {
            state.feedback.response = value;
        },
        setError: (state,value) => {
            state.feedback.error = value;
        }
    },
    actions: {
        activate: ({ commit }) => {
            setTimeout(() => {
                commit('setActive',true);
            },2000);
        },
        desactivate: ({ commit }) => {
            setTimeout(() => {
                commit('setActive',false);
            },2000);
        }
    }
});

export default feedbackStore;