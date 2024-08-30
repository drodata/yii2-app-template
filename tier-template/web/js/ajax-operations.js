/**
 * Global ajax operations
 */
$(function(){
    /**
     * Generic print binding
     */
    $(document).on('click', '.direct-print', function(e) {
    	e.preventDefault();
        $(this).tooltip('hide');
        var postData = $(this).data('post')
    	$.post(APP.baseUrl + 'site/fetch-print-data', postData, function(response) {
    		$(".generic-print-wrapper").empty().html( response ).jqprint();
    	}); 
    }); 
});
