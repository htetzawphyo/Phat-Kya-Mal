import axios from "axios";
import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import cookie from '../composables/cookie.js';

export const useAuthStore = defineStore('authStore', () => {
    // ROUTER
    const router = useRouter();

    // STATE
    const accessToken = ref(cookie.getCookie('accessToken') || null);
    const authorizeUser = ref([]);
    const errMsg = ref([]);

    // GETTER
    const getErrMsg = computed( () => {
        return errMsg.value;
    })

    // ACTIONS
    const login = (formData) => {
        axios.post(`/api/login`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            console.log(response)
            let isToken = response.data.token
            if(isToken){
                accessToken.value = isToken;
                cookie.setCookie('accessToken', isToken);
                authorizeUser.value = response.data.data;
                router.push({name: 'admin'});
            }else{
                errMsg.value = response.data.message;
            }
        })
        .catch( error => {
            console.log(error)
        })
    }

    const logout = () => {
        axios.post('/api/logout', {
            headers: {
                'Accept': 'application/json'
			}
		})
        .then( response => {
            if(response.status == 200){
                cookie.deleteCookie('accessToken');
                router.push({name: 'home'})
            }
        })
        .catch( error => {
            console.log(error)
        })
    }

    return { accessToken, getErrMsg, login, logout }
})
