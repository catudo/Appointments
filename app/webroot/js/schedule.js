$(function(){
selectOperation();
save()
})


function listSchedule(userId){
    var params ={user_id:userId};
    
    $.ajax({
        url: webroot + "/Schedules/listSchedules",
        type: 'POST',
        data:params,
        success: function(response){
        		//var response = jQuery.parseJSON(r)
				buildTable(response,"table","#tableDiv")
        }
    });
  
}



function selectOperation(){
	$("#content").delegate("#doctors", "change", function(event) {
		var id = $(this).val(); 
		listSchedule(id)
	});
}

function edit(){
	 $("#content").delegate(".edit", "click", function(event) {
	 
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
	
}

function save(){
	$("#content").delegate("#saveSchedule", "click", function(event) {
		
		event.preventDefault();
		var params = $("#saveScheduleForm").serialize()
		$.ajax({
    	    url: webroot + "/Schedules/save",
    	    type: 'POST',
			data:params,
       	 	success: function(r){
        			if(r.errors !=undefined){
        				showErrors(r.errors);
        			}else{
        				clear("#saveUserForm");	
        				$("#doctors").val(r.id);
        				$("#doctors").change();
        				
        				
        			}
    	    }
	    });
	    });
	    
	    		
}
