import { success } from '..';

export default {
  run: () => {
    $(document).on('click', '[js-toggle]', e => {
      const target = $(e.currentTarget);
      const url = target.data('url');
      const table = target.parents('table');
      const active = target.data('active');

      Swal.fire({
        title: `Biztos ${active ? 'inaktiválod' : 'aktiválod'}?`,
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
            method: 'POST',
            success: () => {
              table.DataTable().ajax.reload(false);
              success(`${active ? 'Inaktiválás' : 'Aktiválás'} sikeres`);
            },
          });
        },
      });
    });
  },
};
