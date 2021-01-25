require('./bootstrap');
import Swal from 'sweetalert2';
import 'jquery-datetimepicker';

// import 'select2/dist/js/i18n/hu.js';
import datatablesLang from './locales/hu/datatables.hu.json';

$.extend($.fn.dataTable.defaults, {
  responsive: true,
  autoWidth: false,
  wrapper: 'dataTables_wrapper dt-bootstrap4',
  filterInput: 'form-control form-control-sm',
  lengthSelect: 'form-control form-control-sm',
  language: datatablesLang,
});

$.datetimepicker.setLocale('hu');
$.datetimepicker.defaults = {
  format: 'y-m-d H:i',
  dayofWeekStart: 1,
  step: 15,
};

$(() => {
  $.fn.select2.defaults.set('language', 'hu');

  $('[js-select-2]').select2();

  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    error: (jqXHR) => {
      if ([422].includes(jqXHR.status)) {
        return;
      }

      Swal.fire({
        title: 'AJAX Hiba',
        html: `
          <div>${jqXHR.statusText}</div>
          <div>${jqXHR.responseJSON.message}</div>
        `,
        icon: 'error',
      });

      $('[js-listing-table]').DataTable().ajax.reload(false);
    },
    statusCode: {
      401: () => (location.href = '/'),
      422: (jqXHR) => {
        const formErrors = jqXHR.responseJSON.errors;

        for (const fieldName in formErrors) {
          const field = $(`[name=${fieldName}]`);
          $('.invalid-feedback', field.parent())
            .html(formErrors[fieldName][0])
            .show();
          field.addClass('is-invalid');
        }

        Swal.fire({
          title: 'A kérést nem sikerült feldolgozni',
          icon: 'error',
          html: `Adat validációs probléma <div><code>${JSON.stringify(
            formErrors
          )}</code></div>`,
        });
      },
    },
  });
});
