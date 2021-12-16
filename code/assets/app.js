// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';

// start the Stimulus application
import './bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'

const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');
require('bootstrap-datepicker');
