import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import jQuery from 'jquery';
import 'jquery-mask-plugin';
import 'flowbite';
import Datepicker from 'flowbite-datepicker/Datepicker';
import { locales } from "../../node_modules/flowbite-datepicker/js/i18n/base-locales.js";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR.js";

window.$ = jQuery;

window.Alpine = Alpine;

Alpine.plugin(mask);
Alpine.start();

$(function () {

    $(".kilometros").mask("99,9");
    $(".inteiro").mask("99999999");

    $('input[datepickerselect]').each(function(i, el) {
        Object.assign(Datepicker.locales, pt);
        new Datepicker(el, {
            language: 'pt-BR',
            autohide: true,
            format: 'dd/mm/yyyy',
            orientation: 'bottom left',
            todayHighlight: true,
        });
    });

});


/* <!-- other code inside body ... -->
<script type="module">
    $('p').click(function(){
        $(this).css('background-color', '#ff0000'); // Turn clicked paragraph text red using jQuery
    });
</script>
 */
