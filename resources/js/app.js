import './bootstrap';
import toastr from 'toastr';
import flatpickr from "flatpickr";



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



document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#expiryDate", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "F j, Y",
        allowInput: true,
        disableMobile: "true"
    });
});










