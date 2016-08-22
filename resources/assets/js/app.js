
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.filter('doneLabel', (value) => {
    if (value == 0) {
        return 'Não';
    }

    return 'Sim';
});

Vue.filter('formatDate', (value, format, locale) => {
    if (!format) {
        format = "L";
    }

    if (locale) {
        moment.locale(locale);
    }

    return moment(value).format(format);
});

Vue.filter('formatStatus', (value, bills) => {

    if (bills.length == false) {
        return "muted";
    }

    var count = 0;

    for (var i in bills) {
        if (!bills[i].done) {
            count++;
        }
    }

    if (count > 0) {
        return "danger";
    }

    return "success";

});

const app = new Vue({
    el: 'body',
    components: {
        'app-component': require('./components/appComponent.vue')
    }
});
