
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./functions.js');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('thread-view', require('./components/pages/Thread.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));
Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('wysiwyg', require('./components/Wysiwyg.vue'));
Vue.component('search-text', require('./components/admin/SearchText.vue'));
Vue.component('search-date', require('./components/admin/SearchDate.vue'));
Vue.component('search-bool', require('./components/admin/SearchBool.vue'));
Vue.component('search-option', require('./components/admin/SearchOption.vue'));
Vue.component('index', require('./components/admin/Index.vue'));
Vue.component('add-translation', require('./components/admin/AddTranslation.vue'));
Vue.component('translation-table', require('./components/admin/TranslationTable.vue'));
Vue.component('related-items-input', require('./components/admin/RelatedItemsInput.vue'));

const app = new Vue({
    el: '#app'
});
