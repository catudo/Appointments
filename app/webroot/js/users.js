$(function(){

listUsers()
saveUser()
edit()
})


function listUsers(){
    $.ajax({
        url: webroot + "/users/listUsers",
        type: 'POST',
        success: function(response){
        		//var response = jQuery.parseJSON(r)
				buildTable(response,"userTable","#userTableDiv")
				 
        }
    });
  
}



function edit(){
	 $("#content").delegate(".edit", "click", function(event) {
	 event.preventDefault()
	 $("#password").attr('disabled',true);
     $("#secondPassword").attr('disabled',true);
	 $("#editPassword").show();
	 
	 var params = {userId: $(this).attr('userId') };
		 $.ajax({
    	    url: webroot + "/users/edit",
    	    type: 'POST',
			data:params,
       	 	success: function(response){
        			
					$.fillthis(response);

    	    }
	    });
	});
	
	$("#content").delegate("#editPassword", "click", function(event) {
		$("#password").attr('disabled',false);
     	$("#secondPassword").attr('disabled',false);
	});


}

function saveUser(){
	$("#content").delegate("#saveUserButton", "click", function(event) {
		
		event.preventDefault();
		var params = $("#saveUserForm").serialize()
		$.ajax({
    	    url: webroot + "/users/save",
    	    type: 'POST',
			data:params,
       	 	success: function(r){
        			if(r.errors !=undefined){
        				showErrors(r.errors);
        			}else{
        				clear("#saveUserForm");	
        				listUsers()
        				
        				
        			}
    	    }
	    });
	    });
	    
	    		
}





