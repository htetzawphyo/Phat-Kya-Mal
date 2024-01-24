import axios from "axios";
import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import { getCurrentInstance } from "vue";
import cookie from '../composables/cookie.js';

export const useBookStore = defineStore('bookStore', () => {
    // vue progress
	const internalInstance = getCurrentInstance();

    // TOKEN
    const token = cookie.getCookie('accessToken');

    // ROUTER
    const router = useRouter();
    
    // STATE
    const books = ref([]);
    const metas = ref([]);
    const errMsg = ref([]);
    const mainBook = ref(null);
    const mostDownloadBooks = ref([]);
    const referBook = ref(null);
    const scrollBooks = ref([]);
    const searchBooks = ref();
    const isDownload = ref(false);

    // GETTER
    const getBooks = computed( () => {
		return books.value.data;
	});
    const getMainBook = computed( () => {
        return mainBook.value;
    })
    const getReferBook = computed( () => {
        return referBook.value;
    })
    const getMostDownloadBooks = computed( () => {
        return mostDownloadBooks.value.sort((a,b) => b.download_count - a.download_count);
    })
    const getScrollBook = computed( () => {
        return scrollBooks.value;
    })
    const getSearchBooks = computed( () => {
        return searchBooks.value;
    })

    const getMeta = computed( () => {
        return metas.value;
    })
    const getIndex = computed( () => {
        return metas.value.from;
    })
    const getErrMsg = computed( () => {
        return errMsg.value;
    });

    // ACTIONS
    const getBook = (search='', page=1) => {
        axios.get(`/api/files?search=${search}&page=${page}`)
        .then( response => {
            // console.log(response)
            let resBooks = response.data
			books.value = resBooks
            metas.value = response.data.meta
        })
        .catch( error => {
			errMsg.value = error.response.data.errors;
		})
    }

    const mainSearch = (search) => {
        axios.get(`/api/files?search=${search}`)
        .then( response => {
            // console.log(response.data.data)
            if(response.data.data.length > 0){
                searchBooks.value = response.data.data;
            }else{
                searchBooks.value = '';
            }
        })
        .catch( error => {
            errMsg.value = error.response.data.errors;
        })
    }

    const scrollBook = (currentPage) => {
        axios.get(`/api/files/scroll_book`, {
            params: {
                page: currentPage,
                per_page: 2,
            },
        })
        .then( response => {
            // console.log(response)
            scrollBooks.value = [...scrollBooks.value,...response.data.data];
        })
        .catch( error => {
            console.log(error)
        })
    }

    const mostDownloadBook = () => {
        axios.get(`/api/files/most_download_books`)
        .then( response => {
            // console.log(response.data.data)
            mostDownloadBooks.value = response.data.data;
        })
        .catch( error => {
			errMsg.value = error.response.data.errors;
		})
    }

    const addBook = (book) => {
        internalInstance.appContext.config.globalProperties.$Progress.start();
        axios.post(`/api/files`, book,{
			headers: {
                'Accept': 'application/json',
				'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
			}
		})
		.then( response => {
            // console.log(response)
			router.push({ name: 'book'})
		})
		.catch( err => {
            if(err.response){
                errMsg.value = err.response.data.errors;
            }
		})
        .finally( () => {
			internalInstance.appContext.config.globalProperties.$Progress.finish();
		})
    }

    const editBook = (id) => {
        axios.get(`/api/files/${id}`)
		.then( response => {
            // console.log(response.data.data)
			books.value = response.data
		})
    }

    const detailBook = (author_id,book_id) => {
        axios.get(`/api/files?author_id=${author_id}`)
        .then( response => {
            if(response.data.data.length != 0){
                const resBooks = response.data.data;
                mainBook.value = resBooks.filter( book => book.id == book_id)[0];
                referBook.value = resBooks.filter( book => book.id != book_id);
                books.value = response.data;
            }
        })
    }

    const booksOfAuthor = (author_id) => {
        axios.get(`/api/files/author-book/${author_id}`)
        .then( response => {
            if(response.data.status == 200){
                books.value = response.data;
            }
        })
    }

    const updateBook = (id, formData) => {
        internalInstance.appContext.config.globalProperties.$Progress.start();
        axios.post(`/api/files/${id}`, formData, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
			}
		})
		.then(response => {
            // console.log(response)
            if(response.data.status == 201){
                router.push({name: 'book'})
            }
		})
		.catch(error => {
            if(error.response){
                console.log(error.response.data.errors);
                errMsg.value = error.response.data.errors;
            }
		})
        .finally( () => {
			internalInstance.appContext.config.globalProperties.$Progress.finish();
		})
    }

    const download = (id, name) => {
        axios.get(`/api/files/download/${id}`, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            'responseType': 'blob'
        })
        .then( response => {
            console.log(response)
            
            const fileURL = window.URL.createObjectURL(new Blob([response.data], {type: 'application/pdf'}));
            // window.open(fileURL, '_blank'); // Open in a new tab or window
            const fileLink = document.createElement('a');
            fileLink.href = fileURL;
            fileLink.setAttribute('download', `${name}`);
            fileLink.setAttribute('target', '_blank'); 
            document.body.appendChild(fileLink);
            fileLink.click();
        })
        .finally( () => {
			isDownload.value = false;
		})
    }

    const deleteBook = (id) => {
        internalInstance.appContext.config.globalProperties.$Progress.start();
        axios.delete(`/api/files/${id}`, {
            headers: {
                'Accept': 'application/json',
				'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
            },
        })
        .then( response => {
            // console.log(response)
            getBook();
        })
        .catch( err => {
            console.log(err)
        })
        .finally( () => {
			internalInstance.appContext.config.globalProperties.$Progress.finish();
		})
    }

    return { isDownload, mainBook, referBook, books, getBooks, getErrMsg, getScrollBook, getSearchBooks, booksOfAuthor, mainSearch, getBook, scrollBook, mostDownloadBook, addBook, editBook, updateBook, download, detailBook, deleteBook, getMeta, getIndex, getMainBook, getReferBook, getMostDownloadBooks }
})