import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import jQuery from 'jquery';
import 'jquery-mask-plugin';
import 'flowbite';

window.$ = jQuery;

window.Alpine = Alpine;

Alpine.plugin(mask);
Alpine.start();

$(function () {

    $(".kilometros").mask("99,9");
    $(".inteiro").mask("99999999");

});


/* <!-- other code inside body ... -->
<script type="module">
    $('p').click(function(){
        $(this).css('background-color', '#ff0000'); // Turn clicked paragraph text red using jQuery
    });
</script>
 */
