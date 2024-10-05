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
    $(".cep").mask("99999-999");
    $(".telefone").mask("(99) 99999-9999");

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

    $('#cep').on("blur", function() {
        var cep = $('#cep').val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cep.length === 8) {
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!data.erro) {
                    $('#uf').val(data.uf);
                    $('#cidade').val(data.localidade);
                } else {
                    alert('CEP não encontrado.');
                }
            }).fail(function() {
                alert('Erro ao acessar a API do ViaCEP.');
            });
        } else {
            alert('Por favor, digite um CEP válido.');
        }
    });

    $.getJSON('https://servicodados.ibge.gov.br/api/v1/paises/all', function(data) {

        const select = $('#pais');
        const paises = data.map(pais => ({ nome: pais.nome.abreviado}));

        const paisesSemRepeticao = [...new Set(paises.map(pais => pais.nome))];

        paisesSemRepeticao.forEach(pais => {
            select.append(`<option value="${pais}">${pais}</option>`);
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
