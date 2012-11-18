$(function() {
	initializeDatePicker()
	getDropdown()
	saveAppointment()
	cancel()
})
function initializeDatePicker() {

	$("#date").datepicker({
		altFormat : "dd-mm-yy",
		onSelect : function(e, t) {
			$("#cami_division").html("");
			$("#especiality_division").html("");
			$("#doctor").html("");
			$("#divButtons").hide();
			$("#scheduleTableDiv").html("");

		}
	});

}

function getDropdown() {
	$("#content").delegate(".model", "change", function(event) {
		var model = $(this).attr('id');
		var value = $(this).attr('value');
		var date = $("#date").val();

		$.ajax({
			url : webroot + "/Patient/get_information",
			data : {
				model : model,
				value : value,
				date : date
			},
			type : 'POST',
			success : function(response) {
				switch(model) {
					case"city_id":
						$("#cami_division").html("");
						$("#cami_division").html(response);
						$("#divButtons").hide()

						$("#especiality_division").html("");
						$("#doctor").html("");
						break;
					case"cami_id":
						$("#especiality_division").html("");
						$("#especiality_division").html(response);
						$("#divButtons").hide()

						$("#doctor").html("");
						break;
					case"speciality_id":
						$("#doctor").html("");
						$("#doctor").html(response);
						$("#divButtons").hide()
						break;
					case"doctor_id":
						buildTable(response, "scheduleTable", "#scheduleTableDiv")

						var tds = $("#scheduleTableDiv").find("td")

						if (tds.length > 0) {
							var td = tds[0];
							
							if ($(td).hasClass('dataTables_empty'))
								$("#divButtons").hide()
							else
								$("#divButtons").show()
						} else {
							$("#divButtons").hide()
						}
						break;

				}
			}
		});

	});
}

function listUsers() {
	$.ajax({
		url : webroot + "/users/listUsers",
		type : 'POST',
		success : function(response) {
			//var response = jQuery.parseJSON(r)

		}
	});

}

function edit() {
	$("#content").delegate(".edit", "click", function(event) {
		event.preventDefault()
		$("#password").attr('disabled', true);
		$("#secondPassword").attr('disabled', true);
		$("#editPassword").show();

		var params = {
			userId : $(this).attr('userId')
		};
		$.ajax({
			url : webroot + "/users/edit",
			type : 'POST',
			data : params,
			success : function(response) {

				$("#saveUserForm").populate(response)

			}
		});
	});

	$("#content").delegate("#editPassword", "click", function(event) {
		$("#password").attr('disabled', false);
		$("#secondPassword").attr('disabled', false);
	});

}

function saveAppointment() {
	$("#content").delegate("#saveButton", "click", function(event) {
		event.preventDefault();
		var checked = $("#scheduleTableDiv").find("input:checked");
		
		if(checked.length>0 ){
			$("#saveAppointmentForm").submit();
			
		}else(
			showErrors(['you must select at least one appointment'])
			
		)
		
		
		
		
	});

}

function cancel() {
	$("#content").delegate("#saveButton", "click", function(event) {
	$("#cami_division").html("");
			$("#especiality_division").html("");
			$("#doctor").html("");
			$("#divButtons").hide();
			$("#scheduleTableDiv").html("");
	});
}




function changeStatus() {
	$("#content").delegate(".status", "click", function(event) {
		event.preventDefault();
		var params = {
			userId : $(this).attr('userId')
		};
		$.ajax({
			url : webroot + "/users/changeStatus",
			type : 'POST',
			data : params,
			success : function(response) {
				listUsers()

			}
		});
	});

}

