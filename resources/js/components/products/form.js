import 'ckeditor4';
import dateTimeFields from './dateTimeFields';

export default $(() => {
  dateTimeFields.init();

  $('[js-product-tags]').each((_i, el) => {
    $(el).select2({
      minimumResultsForSearch: 0,
      tags: true,
    });
  });

  $('[js-product-description]').each((_i, el) => {
    const editor = CKEDITOR.replace(el);

    editor.on('required', function (e) {
      alert('Leírást kötelező megadni');
      e.cancel();
    });
  });
});
