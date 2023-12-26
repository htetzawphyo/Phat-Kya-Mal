import { createRouter, createWebHistory } from "vue-router";
import Login from '../components/Login.vue';
import NotFoundPage from '../components/front/NotFoundPage.vue';
import Home from '../front/Home.vue';
import FrontBook from '../front/Book.vue';
import Authors from '../front/Authors.vue';
import DetailAuthor from '../front/DetailAuthor.vue';
import About from '../front/About.vue';
import DetailBook from '../front/DetailBook.vue';
import Dashboard from '../dashboard/Dashboard.vue';
import Author from '../dashboard/author/Author.vue';
import AuthorAdd from '../dashboard/author/AuthorAdd.vue';
import AuthorEdit from '../dashboard/author/AuthorEdit.vue';
import Book from '../dashboard/book/Book.vue';
import BookAdd from '../dashboard/book/BookAdd.vue';
import BookEdit from '../dashboard/book/BookEdit.vue';
import Category from '../dashboard/category/Category.vue';
import CategoryAdd from '../dashboard/category/CategoryAdd.vue';
import Role from '../dashboard/role/Role.vue';
import User from '../dashboard/user/User.vue';

import { useAuthStore } from "../store/AuthStore";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    // {
    //     path: '/book',
    //     name: 'front-book',
    //     component: FrontBook
    // },
    {
        path: '/book/detail/:id/:author_id',
        name: 'book-detail',
        component: DetailBook,
        props: true
    },
    {
        path: '/author',
        name: 'front-author',
        component: Authors
    },
    {
        path: '/author/detail/:id',
        name: 'author-detail',
        component: DetailAuthor,
        props: true
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/admin',
        name: 'admin',
        component: Dashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/author',
        name: 'author',
        component: Author,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/author/add',
        name: 'author-add',
        component: AuthorAdd,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/author/edit/:id',
        name: 'author-edit',
        component: AuthorEdit,
        props: true,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/book',
        name: 'book',
        component: Book,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/book/add',
        name: 'book-add',
        component: BookAdd,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/book/edit/:id',
        name: 'book-edit',
        component: BookEdit,
        props: true,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/category',
        name: 'category',
        component: Category,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/category/add',
        name: 'category-add',
        component: CategoryAdd,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/role',
        name: 'role',
        component: Role,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/user',
        name: 'user',
        component: User,
        meta: { requiresAuth: true }
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundPage
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    const isAuthenticated = !!authStore.accessToken;
    
    if(to.meta.requiresAuth && !isAuthenticated){
        next({name: 'login'});
    }else{
        next();
    }
})

export default router