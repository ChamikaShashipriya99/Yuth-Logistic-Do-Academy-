/* global jQuery, ajaxurl, YouthLogisticServiceOrder */
(function ($) {
    'use strict';

    var $list = $('#youth-logistic-service-order');
    var $feedback = $('#youth-logistic-service-order-feedback');

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
        placeholder: 'service-order-placeholder',
        axis: 'y',
        update: function () {
            var order = [];
            $list.find('.service-order-item').each(function () {
                order.push($(this).data('id'));
            });

            $.post(
                ajaxurl,
                {
                    action: 'youth_logistic_update_service_order',
                    nonce: YouthLogisticServiceOrder.nonce,
                    order: order
                }
            )
                .done(function (response) {
                    if (response && response.success) {
                        showMessage(YouthLogisticServiceOrder.success, 'success');
                    } else {
                        showMessage(YouthLogisticServiceOrder.failure, 'error');
                    }
                })
                .fail(function () {
                    showMessage(YouthLogisticServiceOrder.failure, 'error');
                });
        }
    });
})(jQuery);

