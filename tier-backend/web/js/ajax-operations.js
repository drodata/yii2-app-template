/**
 * Global ajax operations
 */
$(function(){
    
    // global modal show handler
    $(document).on('show.bs.modal', '.modal', function () {
        // enable nested bootstrap modal
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);

        // opt in tooltip and popover in modal
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });

    $('.submit-once').on('click', function (e) {
        var $button = $(this);
        if ($button.data('brother') == undefined) {
            var $brother = $(document.createElement($button[0].tagName));
            $brother.html('处理中……');
            $brother.attr('disabled', true);
            $brother.addClass('disabled');
            $brother.addClass($button.attr('class'));
            $brother.hide();
            $brother.insertAfter($button);
            $button.data('brother', $brother)
        }else{
            var $brother = $button.data('brother');
        }

        if ($button.css('display') !== 'none') {
            $brother.show();
            $button.hide();
            setTimeout(function () {
                $brother.hide();
                $button.show();
            }, 10000);
        }
    });

    /**
     * 将普通的 view action 改用在 Modal 内显示
     */
    $(document).on('click', '.modal-view', function(e) {
        e.preventDefault();

        var selecter = '#view-modal'
        $(this).tooltip('hide');

        var queryString = $(this).prop('href').split('?')[1];
        var slices = $(this).prop('href').split('?')[0].split('/');
        var controller = slices[slices.length - 2];
        var action = slices[slices.length - 1];
        var ajaxRoute = controller + '/modal-' + action + '?' + queryString;

        $.get(APP.baseUrl + ajaxRoute, function(response) {
            $(response).appendTo('body');
            $(selecter).modal('show')
        }).fail(ajax_fail_handler).always(function(){
            $(document).on('hide.bs.modal', selecter, function() {
                $(selecter).remove()
            });
        })
    });
    /**
     * 通用的高级搜索
     */
    $(document).on('click', '.modal-search', function(e) {
        e.preventDefault();

        var selecter = '#search-modal'
        $(this).tooltip('hide');

        $.get($(this).prop('href'), function(response) {
            $(response).appendTo('body');
            $(selecter).modal('show')
        }).fail(ajax_fail_handler).always(function(){
            $(document).on('hide.bs.modal', selecter, function() {
                $(selecter).remove()
            });
        })
    });

});
