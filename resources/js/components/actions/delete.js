import { success } from '..';

export default {
  run: () => {
    $(document).on('click', '[js-delete]', e => {
      const target = $(e.currentTarget);
      const url = target.data('url');
      const title = target.data('title');
      const table = target.parents('table');

      Swal.fire({
        title,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Mégsem',
        showLoaderOnConfirm: true,
        customClass: {
          confirmButton: 'btn btn-danger m-1',
          cancelButton: 'btn btn-secondary m-1',
        },
        confirmButtonText: 'Igen',
        html: false,
        preConfirm: () => {
          return $.ajax({
            url,
            method: 'DELETE',
            success: () => {
              table.DataTable().ajax.reload(false);
              success();
            },
          });
        },
      });
    });
  },
};
