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
    /*
    $('#batch-print-shipment-btn').click(function(e){
        var ab = $(this); 
	    $('<span id="loading">' + APP.loadingText + '</span>').appendTo(ab);
        ab.prop('disabled',true);
        var postData = {ids: ab.data('ids')};
	    $.post(APP.baseUrl + 'order/ajax-batch-print-shipment', postData, function(response) {
            // higlight printed row
            $('#preparing-grid').find('tr').each(function(){
                var currentRow = $(this);
                if (in_array(currentRow.data('key'), ab.data('ids'))) {
                    currentRow.addClass('bg-success');
                }
            });
            // popup print dialog
            var pdf = new PdfUtil(APP.baseUrl + 'merged.pdf');
            pdf.display(document.getElementById('pdf-shipment-container'));
            pdf.print();
	    }).fail(ajax_fail_handler).always(function(){
		    ab.prop('disabled',false).find('#loading').remove();
        });
    });
    */
});
