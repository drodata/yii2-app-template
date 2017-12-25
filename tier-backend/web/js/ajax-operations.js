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

        $(this).tooltip('hide');

        var queryString = $(this).prop('href').split('?')[1];
        var slices = $(this).prop('href').split('?')[0].split('/');
        var controller = slices[slices.length - 2];
        var action = slices[slices.length - 1];
        var ajaxRoute = controller + '/modal-' + action + '?' + queryString;

        $.get(APP.baseUrl + ajaxRoute, function(response) {
            $(response).appendTo('body');
            $('#view-modal').modal('show')
        }).fail(ajax_fail_handler).always(function(){
            $(document).on('hide.bs.modal', '#view-modal', function() {
                $('#view-modal').remove()
            });
        })
    });

    // 在 Modal 内通过 AJAX 快速新增 Lookup 记录(仅 name 列)
    $(document).on('click', '.ajax-quick-create-lookup', function() {
        var dropDown = {
            element: $(this).parents('.input-group').first().find('select'),
            type: $(this).data('type'),
        };
	        $.get(APP.baseUrl + 'lookup/ajax-get-modal?type=' + dropDown.type, function(response) {
                $(response).appendTo('body');

                $('#' + dropDown.type + '-modal').modal({
                    'keyboard': false,
                    'backdrop': 'static',
                }).on('hidden.bs.modal', function (e) {
                    $('#' + dropDown.type + '-modal').remove();
                }).on('shown.bs.modal', function (e) {
                    $('#lookup-name').focus();
                });
            
                var selecter = '#lookup-quick-create-form'
                var lookup = {
                    form: $(selecter),
                    model: $(selecter).afGetYii2('Lookup'),
                    submit: {
                        element: $(selecter).find('[type=submit]'),
                        originalText: $(selecter).find('[type=submit]').text(),
                    },
                };
                lookup.form.submit(function(e) {
                	e.preventDefault();
                	e.stopImmediatePropagation();
                	lookup.submit.element.prop('disabled',true)
                	$.post(APP.baseUrl + 'lookup/ajax-quick-create', lookup.form.serialize(), function(response) {
                		if (!response.status) {
                            lookup.form.displayErrors(response)
                        } else {
                            $( response.message ).appendTo(lookup.submit.element.parent());
                            $( response.entity ).appendTo(dropDown.element);
                            dropDown.element.trigger('change');
                        
                			setTimeout(function(){
                                $('#' + dropDown.type + '-modal').modal('hide');
                			},1000);
                        }
                	}).fail(ajax_fail_handler).always(function() {
                	    lookup.submit.element.prop('disabled',false)
                	});
                }); //!submit event
            }); //!create modal fetch
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
