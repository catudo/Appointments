$(function(){
selectOperation();
save()
edit()
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
	 event.preventDefault();
	 var params = {userId: $(this).attr('userId') };
		 $.ajax({
    	    url: webroot + "/Schedules/edit",
    	    type: 'POST',
			data:params,
       	 	success: function(response){
        			
						$("#saveScheduleForm").populate(response,{identifier:'id'})

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
        				clear("#saveScheduleForm");	
        				console.log(r.id);
        				$("#doctors").val(r.id);
        				$("#doctors").change();
        				
        				
        			}
    	    }
	    });
	    });
	    
	    		
}
