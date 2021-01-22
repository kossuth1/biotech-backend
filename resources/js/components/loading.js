export default () => {
  Swal.fire({
    onBeforeOpen: () => Swal.showLoading(),
    title: 'Kérlek, várj...',
  });
};
