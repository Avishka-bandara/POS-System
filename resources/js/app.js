import './bootstrap';
import toastr from 'toastr';



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';


toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "showMethod": "fadeIn",
            "positionClass": "toast-top-right", 
            "timeOut": "3000"
        };












