import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import jQuery from 'jquery';
import 'jquery-mask-plugin';
import 'flowbite';
import Datepicker from 'flowbite-datepicker/Datepicker';
import { locales } from "../../node_modules/flowbite-datepicker/js/i18n/base-locales.js";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR.js";
import { Calendar } from 'fullcalendar';
import { min, runInContext } from 'lodash';

window.$ = jQuery;

window.Alpine = Alpine;

Alpine.plugin(mask);
Alpine.start();

$(function () {

    const BASEURL = '/';

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
            minDate: new Date()
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

    var calendarEl = document.getElementById('calendar');
    if (calendarEl !==  null) {
        var calendar = new Calendar(calendarEl, {
            initialView: 'dayGridWeek',
            locale: 'pt-BR',
            timeZone: 'local',
            navLinks: true,
            nowIndicator: true,
            dayMaxEventRows: true,
            buttonText: {
                year: 'Ano',
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },
            headerToolbar: {
                left: 'dayGridWeek dayGridMonth',
                center: 'title',
                right: 'novo prevYear,prev,next,nextYear'
            },
            customButtons: {
                novo: {
                    text: 'Agendar visita',
                    click: function() {
                        window.location.href = BASEURL + 'visitas/create';
                    }
                },
            },
            events: {
                url: BASEURL + 'calendario',
                type: 'GET',
                error: function() {
                    alert('Problema ao buscar os dados');
                }
            },
        });
        calendar.render();
    }

    // Muda a quantidade de condutores de acordo número de pessoas
    $('#quantidade-pessoas').on("change", function() {

        var visitantesPorCondutor = parseInt($('#visitantesPorCondutor').val());
        
        var quantidadePessoas = parseInt($('#quantidade-pessoas').val());
        var quantidadePessoasEfetivo = Math.ceil(quantidadePessoas / visitantesPorCondutor);
        $('#quantidade-pessoas-efetivo').val(quantidadePessoasEfetivo);
    });

});


/* <!-- other code inside body ... -->
<script type="module">
    $('p').click(function(){
        $(this).css('background-color', '#ff0000'); // Turn clicked paragraph text red using jQuery
    });
</script>
 */
