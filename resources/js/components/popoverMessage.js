export default (
  selector,
  content,
  type = 'success',
  delayToHide = 2000,
  placement = 'top'
) => {
  const popover = selector
    .popover({
      content: `<span class="text-${type}">${content}</span>`,
      placement,
      html: true,
    })
    .popover('show');

  setTimeout(() => {
    popover.popover('dispose');
  }, delayToHide);
};
