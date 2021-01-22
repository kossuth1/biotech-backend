$(() => {
  $('[js-products-table]').on('click', '[js-delete-product]', function () {
    const target = $(this);
    const url = target.data('url');
    const table = target.parents('table');

    Swal.fire({
      title: 'Biztos törlöd?',
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
            table.DataTable().draw(true);
            success('Törölve');
          },
        });
      },
    });
  });
});

$('[js-products-table]').DataTable({
  serverSide: true,
  searchDelay: 500,
});
