import axios from "axios"

export default {
    state: {
       categotyData: [],
    },
    getters: {
        categories(state) {
            return state.categotyData;
        }
    },
    actions: {
        getCategoriess(data){
            axios.get('/api/category').then((response)=>{
                data.commit('categoriess', response.data.categories)

            }).catch((error)=>{
                console.log(error);

            });
        }
    },
    mutations: {
        categoriess(state, data) {
            return state.categotyData = data;

        },

    }
}
