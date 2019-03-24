
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/*require('./errorode');
require('./addToge');
require('./cal');
require('./formCheck');
require('./npv');*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$('select.selectize').selectize({ maxItems: 3 });
$('textarea.wysiwyg').markdown({ iconlibrary: 'fa' });

// const app = new Vue({
//     el: '#app'
// });
