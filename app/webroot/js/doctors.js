$(function(){

listUsers()
saveUser()
edit()
changeStatus()
})


function listUsers(){
    $.ajax({
        url: webroot + "/Admindoctor/listUsers",
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
        			
					$("#saveUserForm").populate(response)

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
    	    url: webroot + "/Admindoctor/save",
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



function changeStatus(){
	 $("#content").delegate(".status", "click", function(event) {
	 event.preventDefault();
	 var params = {userId: $(this).attr('userId') };
		 $.ajax({
    	    url: webroot + "/users/changeStatus",
    	    type: 'POST',
			data:params,
       	 	success: function(response){
        			listUsers()
	
    	    }
	    });
	});

}




