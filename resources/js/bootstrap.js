// boostrap.js
import axios from "axios";
import $ from "jquery";

import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "datatables.net";
import "datatables.net-bs5";

window.axios = axios;
window.$ = window.jQuery = $;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
