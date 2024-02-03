import axios from "axios";
import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import cookie from '../composables/cookie.js';

export const useAuthStore = defineStore('authStore', () => {
    // ROUTER
    const router = useRouter();

    // TOKEN
    const token = cookie.getCookie('accessToken');

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
            let isToken = response.data.token
            if(isToken){
                accessToken.value = isToken;
                cookie.setCookie('accessToken', isToken);
                console.log(isToken);
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
        console.log(token);
        axios.post('/api/logout' , {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
            }
        })
        .then( response => {
            console.log(response)
            if(response.status == 200){
                // accessToken.value = null;
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