$(function() {
listAppointments()
deleteAppointment()
})


function listAppointments(){
    $.ajax({
        url: webroot + "/Patient/list_appointment_response",
        type: 'POST',
        success: function(response){
        		buildTable(response,"appointmentTable","#appointmentTableDiv")
        }
    });
  
}

function deleteAppointment(){
 $("#content").delegate(".cancel", "click", function(event) {	
 	var id = $(this).attr("appointmentId");
 	console.log(id);
	 $( "#modalConfirmation" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Cancel Appointment": function() {
                		
			$.ajax({
		        url: webroot + "/Patient/delete_appointment",
        		type: 'POST',
        		data:{id:id},
        		success: function(response){
    				if(response.errors !=undefined ){
    					showErrors(response.errors);
    				} else{
    					listAppointments()
    				} 
				 
        		}
    });
	
                $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
   
   });
    
}
