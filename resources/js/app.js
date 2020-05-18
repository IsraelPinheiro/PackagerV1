require('./bootstrap');
require('./sb-admin-2')
require('chart.js')
import swal from 'sweetalert';
require('datatables')
require('datatables.net-bs4')
require('jquery-mask-plugin')
require('jquery.easing')
require('chart.js')

//Datatables Initialisation
require('./datatables.init')

//Page specific code
require('./pages/common')
require('./pages/users')
require('./pages/profiles')
require('./pages/dashboards')