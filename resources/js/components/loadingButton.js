import { success } from '.';

export default (btn, action) => {
  const origHtml = btn.html();

  btn.prop('disabled', true).html('<i class="fa fa-spin fa-cog"></i>');
  action.then(() => {
    btn.prop('disabled', false).html(origHtml);
    success();
  });
};
