$(function(){
change()
})


function change(){
	$("#content").delegate(".btn-primary", "click", function(event) {
		event.preventDefault();
		var params = $(".form-horizontal").serialize();
		
		if($("#password").val()==$("#secondPassword").val()){
			$.ajax({
        	url: webroot + "/Patient/change_password_function",
       	 	type: 'POST',
        	data:params,
        	success: function(response){
      			if(response.errors!=undefined){
      					
      			}else{
      				showErrors(['password updated']);
      				clear(".form-horizontal");
      				
      			}  
        }
    });	
			
		}{
			showErrors(['password and second password must be equals']);
		}
		
		
	});
	
	
	
	
    
    
}
