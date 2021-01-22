export default jqXHR => {
  let error = 'Ismeretlen hiba';

  if (jqXHR.status == 401) {
    error = 'Lejárt munkamenet';
  } else if (jqXHR.status == 422) {
    const field = Object.keys(jqXHR.responseJSON.errors)[0];
    error = jqXHR.responseJSON.errors[field][0];
  }

  Swal.showValidationMessage(`A művelet sikertelen: ${error}`);
};
