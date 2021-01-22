export default (instance, message, xhr) => {
  if (!xhr) {
    $('.dz-progress').remove();
  }

  const title = message.message || message;
  let text = '';

  if (!Swal.isVisible() && xhr) {
    const multi = message.errors.length > 1;

    text =
      (multi ? '<ul class="text-left">' : '') +
      Object.keys(message.errors)
        .map(
          error =>
            (multi ? '<li>' : '') +
            message.errors[error][0] +
            (multi ? '</li>' : '')
        )
        .join('') +
      (multi ? '</ul>' : '');
  }

  if (Swal.isVisible()) {
    $('[data-dz-errormessage]').html(title);
  } else {
    Swal.fire({ title, icon: 'error', html: text });
    instance.removeFile(instance.files[0]);
  }
};
