$(function(){

listCami()
saveCami()
edit()
})


function listCami(){
    $.ajax({
        url: webroot + "/cami/listCami",
        type: 'POST',
        success: function(response){
        		//var response = jQuery.parseJSON(r)
				buildTable(response,"camiTable","#camiDiv")
				 
        }
    });
  
}



function edit(){
	 $("#content").delegate(".edit", "click", function(event) {
	 event.preventDefault()
	
	 var params = {id: $(this).attr('id') };
		 $.ajax({
    	    url: webroot + "/cami/edit",
    	    type: 'POST',
			data:params,
       	 	success: function(response){
        			
					$("#saveCamiForm").populate(response)

    	    }
	    });
	});
	
	


}

function saveCami(){
	$("#content").delegate("#saveCami", "click", function(event) {
		
		event.preventDefault();
		var params = $("#saveCamiForm").serialize()
		$.ajax({
    	    url: webroot + "/cami/save",
    	    type: 'POST',
			data:params,
       	 	success: function(r){
        			if(r.errors !=undefined){
        				showErrors(r.errors);
        			}else{
        				clear("#saveCamiForm");	
        				listCami()
        				
        				
        			}
    	    }
	    });
	    });
	    
	    		
}





