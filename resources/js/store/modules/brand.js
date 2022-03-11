import axios from "axios"

export default {
    state: {
       BrandData: [],
    },
    getters: {
        brand(state) {
            return state.BrandData;
        }
    },
    actions: {
        getBrands(data){
            axios.get('/api/brand').then((response)=>{
                data.commit('brand', response.data.brands)

            }).catch((error)=>{
                console.log(error);

            });
        }
    },
    mutations: {
        brand(state, data) {
            return state.BrandData = data;

        },

    }
}
