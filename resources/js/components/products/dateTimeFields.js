export default {
  init: () => {
    const publicFrom = $('[js-product-public-from]');
    const publicTo = $('[js-product-public-to]');
    const dateFormat = 'YYYY-MM-DD';
    const timeFormat = 'hh:mm';
    const dateTimeFormat = `${dateFormat} ${timeFormat}`;

    const publicFromDt = moment(publicFrom, dateTimeFormat);
    const publicToDt = moment(publicTo, dateTimeFormat);

    publicFrom.datetimepicker({
      ...$.datetimepicker.defaults,
      maxDate: !!publicFrom.val() && publicToDt.format(dateFormat),
      maxTime: !!publicFrom.val() && publicToDt.format(timeFormat),
    });

    publicTo.datetimepicker({
      ...$.datetimepicker.defaults,
      minDate: !!publicTo.val() && publicFromDt.format(dateFormat),
      minTime: !!publicTo.val() && publicFromDt.format(timeFormat),
    });

    publicTo.on('change', function () {
      const to = moment(publicTo.val(), dateTimeFormat);

      publicFrom.datetimepicker('setOptions', {
        maxDate: to.format(dateFormat),
        maxTime: to.format(timeFormat),
      });
    });

    publicFrom.on('change', function () {
      const from = moment(publicFrom.val(), dateTimeFormat);

      publicTo.datetimepicker('setOptions', {
        minDate: from.format(dateFormat),
        minTime: from.format(timeFormat),
      });
    });
  },
};
