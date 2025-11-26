/* global jQuery, ajaxurl, YouthLogisticStatsOrder */
(function ($) {
    'use strict';

    var $list = $('#youth-logistic-stats-order');
    var $feedback = $('#youth-logistic-stats-order-feedback');

    if (!$list.length) {
        return;
    }

    var showMessage = function (message, type) {
        $feedback
            .removeClass('notice-success notice-error')
            .addClass('notice ' + (type === 'error' ? 'notice-error' : 'notice-success'))
            .text(message);
    };

    $list.sortable({
        placeholder: 'stats-order-placeholder',
        axis: 'y',
        update: function () {
            var order = [];
            $list.find('.stats-order-item').each(function () {
                order.push($(this).data('id'));
            });

            $.post(
                ajaxurl,
                {
                    action: 'youth_logistic_update_stats_order',
                    nonce: YouthLogisticStatsOrder.nonce,
                    order: order
                }
            )
                .done(function (response) {
                    if (response && response.success) {
                        showMessage(YouthLogisticStatsOrder.success, 'success');
                    } else {
                        showMessage(YouthLogisticStatsOrder.failure, 'error');
                    }
                })
                .fail(function () {
                    showMessage(YouthLogisticStatsOrder.failure, 'error');
                });
        }
    });
})(jQuery);

