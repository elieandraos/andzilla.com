
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue2TouchEvents from 'vue2-touch-events';

require('bootstrap-select');
require('bootstrap-datepicker');;
require('daterangepicker');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('transactions', require('./components/Transactions.vue')); 
Vue.component('graph-pie', require('./components/GraphPie.vue'));
Vue.component('graph-line', require('./components/GraphLine.vue'));
Vue.component('graph-horizontal-bar', require('./components/graphHorizontalBar.vue'));
Vue.component('dashboard-income-widget', require('./components/DashboardIncomeWidget.vue'));
Vue.component('dashboard-transactions-widget', require('./components/DashboardTransactionsWidget.vue'));
Vue.component('dashboard-category-widget', require('./components/DashboardCategoryWidget.vue'));
 
Vue.use(Vue2TouchEvents);

const app = new Vue({
    el: '#app'
});

$(document).ready(function(){
	$('.selectpicker').selectpicker({
	 	'liveSearch' : true,
	 	'showTick' : true,
	 	'tickIcon' : 'fa-check',
	 	'iconBase' : 'fa'
	});

	$('.datepicker').datepicker({
	    format: "dd M, yyyy",
	    clearBtn: true,
	    orientation: "bottom auto",
	    todayHighlight: true
	});
})
