import 'ckeditor4';

$(() => {
  $('[js-product-tags]').each((_i, el) => {
    console.log({ el });
    $(el).select2({
      minimumResultsForSearch: 0,
      tags: true,
    });
  });

  $('[js-product-description]').each((_i, el) => {
    CKEDITOR.replace(el);
  });
});
