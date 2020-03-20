import Vue from "vue";

require('./bootstrap');

import App from "./components/App";

new Vue({
	el: "#app",
	components: { App }
});
