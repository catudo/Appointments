(function( $ ){
    $.fillthis = $.fn.fillthis = function( inputValue ) {

        try {
            json = $.parseJSON(inputValue);
            jQuery.each(inputValue, function(fieldId, value) {

                try { // try if we can select by id
                    var inputType = $("#"+fieldId)[0].type;
                }
                catch(e) { // if not, then it must be a name value for radio button
                    var inputType = $("input[name="+fieldId+"]")[0].type;
                }

                if(inputType=='text' || inputType=='textarea' || inputType=='hidden' || inputType=='password' || inputType=='select-one') {
                    $("#"+fieldId).val(value);
                }
                else if(inputType=='select-multiple') {
                    var arrayMultipleValues = value.split(';');
                    $("#"+fieldId).val(arrayMultipleValues);
                }
                else if(inputType=='checkbox') {
                    if(inputValue!='' && value!="0") {
                        $("#"+fieldId).attr('checked',true);
                    }
                    else if(value=="" || value=="0") {
                        $("#"+fieldId).attr('checked',false);
                    }
                }
                else if(inputType=='radio') {
                    $("input[name="+fieldId+"]").filter("[value="+value+"]").prop("checked",true);
                }
                else {
                    $.error('This element type is not an input element.');
                }
            });

        } catch (e) {
            // alert(e);
            if($(this).length) {
                var inputType = this[0].type;

                if(inputType=='text' || inputType=='textarea' || inputType=='hidden' || inputType=='password' || inputType=='select-one') {
                    $(this).val(inputValue);
                }
                else if(inputType=='select-multiple') {
                    var arrayMultipleValues = inputValue.split(';');
                    $(this).val(arrayMultipleValues);
                }
                else if(inputType=='checkbox') {
                    if(inputValue!='' && inputValue!="0") {
                        $(this).attr('checked',true);
                    }
                    else if(inputValue=="" || inputValue=="0") {
                        $(this).attr('checked',false);
                    }
                }
                else if(inputType=='radio') {
                    $(this).filter("[value="+inputValue+"]").prop("checked",true);
                }
                else {
                    $.error('This element type is not an input element.');
                }
            }
            else {
                $.error('Object does not exist!');
            }
        }
    };
})( jQuery );