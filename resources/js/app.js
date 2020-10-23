/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('course-popular', require('./components/Course/CoursePopular.vue').default);
Vue.component('course-list', require('./components/Course/CourseList.vue').default);
Vue.component('course-detail', require('./components/Course/CourseDetail.vue').default);
Vue.component('course-forum', require('./components/Course/CourseForum.vue').default);

Vue.component('question-list', require('./components/Question/QuestionList.vue').default);
Vue.component('question-create', require('./components/Question/QuestionCreate.vue').default);

Vue.component('log-list', require('./components/Log/LogList.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
