import axios from "axios";
import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import cookie from '../composables/cookie.js';

export const useAuthorStore = defineStore('authorStore', () => {
    // TOKEN
    const token = cookie.getCookie('accessToken');

    // ROUTER
    const router = useRouter();

    // STATE
    let authors = ref([]);
    let metas = ref([]);
    let errMsg = ref([]);

    // GETTER
    const getAuthors = computed( () => {
		return authors.value.data;
	})
    const getMeta = computed( () => {
        return metas.value;
    })
    const getIndex = computed( () => {
        return metas.value.from;
    })

    const getErrMsg = computed( () => {
        return errMsg.value;
    })

    // ACTIONS
    const getAuthor = (search='',page=1) => {
        axios.get(`/api/authors?search=${search}&page=${page}`)
        .then( response => {
            let resAuthors = response.data
			authors.value = resAuthors
            metas.value = response.data.meta
            // console.log(response)
        })
        .catch( error => {
			console.log(error)
		})
    }

    const addAuthor = (author) => {
		axios.post(`/api/authors`, author,{
			headers: {
                'Accept': 'application/json',
				'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
			}
		})
		.then( response => {
            // console.log(response)
			router.push({ name: 'author'})
		})
		.catch( err => {
            // console.log(err.response.data.errors)
			errMsg.value = err.response.data.errors;
		})
	}

    const editAuthor = (id) => {
        axios.get(`/api/authors/${id}`)
		.then( response => {
            // console.log(response.data)
			authors.value = response.data
		})
    }

    const updateAuthor = (id, formData) => {
        axios.post(`/api/authors/${id}`, formData, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
			}
		})
		.then(response => {
            // console.log(response)
			router.push({name: 'author'})
		})
		.catch(error => {
            if(error.response.data.errors){
                errMsg.value = error.response.data.errors;
            }
		});
    }

    const deleteAuthor = (id) => {
        axios.delete(`/api/authors/${id}`, {
            headers: {
                'Accept': 'application/json',
				'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
            },
        })
        .then( response => {
            // console.log(response)
            getAuthor();
        })
        .catch( err => {
            console.log(err)
        })
    }

    return { authors, getAuthors, getErrMsg, getMeta, getIndex, getAuthor, addAuthor, editAuthor, updateAuthor, deleteAuthor }
})