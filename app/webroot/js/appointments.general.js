var webroot = '/Appointments'
$(function(){

});


function showErrors(list){
        var totalString="";
        
        $("#messageDiv").html("");
        
        for (message in list){
        	totalString =totalString +"<p>"+list[message]+"</p>";
        }
        $("#messageDiv").html(totalString);
        
        $( "#errorsDiv" ).dialog({
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        
}


function showAndHideContainers(link, container,callback){
	 $("#content").delegate(link, "click", function(event) {
	 	event.preventDefault();
		if($(container).is(":hidden")){
			$(container).slideDown()
		}else{
			$(container).slideUp()

		}

			var form = $(container).find("form")

			if(typeof callback == 'function'){
    		    callback.call(this);
	      }



		});

}

function __(language_key) {
	var y = document.createElement('span');
	try {
		if (LK[language_key] != null) {
			y.innerHTML = LK[language_key];
		} else {
			y.innerHTML = language_key;
		}
	} catch (e) {
		y.innerHTML = language_key;
	}

	return y.innerHTML;
}


function clear(form) {
	$(form).find(':input').each(function() {
	        switch(this.type) {
	            case 'hidden':
	            	if(!$(this).hasClass("dont"))
	                $(this).val('');
	                break;
	        }
	    });
	$(form).each(function() {
		this.reset();
	});
}

function buildTable(response,tableId,container){
	$(container).html( '<table id="'+tableId+'" class="basic_table" style="width: 100%;"></table>' );
	 	var tableParams = {
        "bJQueryUI": true,
        "aaData": response.aaData,
        sDom: response.sDom,
        "bAutoWidth": false,
        "aoColumns": response.aoColumns,
        "sScrollY": response.sScrollY,
        "iDisplayLength": -1,
    	"oLanguage": {
			"sProcessing": __("sProcessing"),
			"sLengthMenu": __("sLengthMenu"),
			"sZeroRecords": __("sZeroRecords"),
			"sInfo": __("sInfo"),
			"sInfoEmpty": __("sInfoEmpty"),
			"sInfoFiltered": __("sInfoFiltered"),
			"sInfoPostFix": __("sInfoPostFix"),
			"sSearch": __("sSearch"),
			"sUrl": "",
			"oPaginate": {
				"sFirst":    __("sFirst"),
				"sPrevious": __("sPrevious"),
				"sNext":     __("sNext"),
				"sLast":    __("sLast")
			}
		}

    }

	if(response.aoColumnDefs !=undefined ){
		$.extend(true,tableParams,{"aoColumnDefs":response.aoColumnDefs});

	}

	
	var table = $('#'+tableId).dataTable(tableParams);

	 return table;


}
