window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.csrf_token = document.querySelector('meta[name="csrf-token"]').content;
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token;

require("./vee-validate");
