
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from "vue"
import BootstrapVue from 'bootstrap-vue'

import VeeValidate from 'vee-validate';
import Snotify, { SnotifyPosition } from 'vue-snotify';

import moment from 'moment';

const config = {
  aria: true,
  classNames: {},
  classes: false,
  delay: 0,
  dictionary: null,
  errorBagName: 'errors', // change if property conflicts
  events: 'input|blur',
  fieldsBagName: 'errorField',
  i18n: null, // the vue-i18n plugin instance
  i18nRootKey: 'validations', // the nested key under which the validation messages will be located
  inject: true,
  locale: 'en',
  validity: false
};

Vue.use(VeeValidate, config);

Vue.use(BootstrapVue);
Vue.use(moment);

window.Vue = require('vue');


const options = {
  toast: {
    position: SnotifyPosition.rightTop
  }
}

Vue.use(Snotify, options)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('teachercourses', require('./components/ProfileTeacherCourse.vue'));

Vue.component('example', require('./components/Example.vue'));
Vue.component('course', require('./components/Course.vue'));
Vue.component('profile-image', require('./components/ProfileImage.vue'));
Vue.component('student-document', require('./components/StudentDocument.vue'));
Vue.component('student-profile-doc', require('./components/StudentProfileDoc.vue'));
Vue.component('student-address', require('./components/StudentAddress.vue'));
Vue.component('student-qualification', require('./components/StudentQualification.vue'));
Vue.component('hostel-assign', require('./components/HostelAssign.vue'));
Vue.component('student-marks', require('./components/StudentMarks.vue'));

const app = new Vue({
    el: '#app',
    filters: {
      moment: function (date) {
        return moment(date).format('MMMM Do YYYY, h:mm:ss a');
      }
    }
});
