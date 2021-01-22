export default (message = 'Sikeres művelet') => {
  One.helpers('notify', {
    type: 'success',
    icon: 'fa fa-check mr-1',
    message,
  });
};
