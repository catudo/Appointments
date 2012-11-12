/**
 *  ===================================================
 *  jQuery.fillthis.js v1.1
 *  @Source: https://github.com/bulma171/fillthis.jquery.js
 *  @Author: Omar Ayoubi - me@omarayoubi.be
 *  ===================================================
 *
 * This source file is free software, under either the GPL v2
 * http://www.gnu.org/licenses/licenses.html
 *
 * SUMMARY:
 * This plugin allows you to fill-up any form elements with a simple line of code
 * You can pass all the fields value at once with a JSON object (check examples below)
 * it's very useful if, for example you want to dynamically pre-fill your form from a server side scripts.
 *
 * EXAMPLE OF USAGE:
 *
 * Single input (text): $("#formElement").fillwith('Niahaha!');
 * Single input (multiselect): $("#formElement").fillwith('Bruxelles;Diegem;Waterloo');
 *
 * Using JSON:
 * $.fillthis({
 *  "street": "the street",
 *  "notes": "text notes",
 *  "currency": "eur;usd",
 *  "city": "Brussels"
 * });
 *
 *
 * TIPS:
 * - For checkboxes, if you want to uncheck it, you can leave the value empty or set it  to "0" otherwise whatever
 * you define, it will be interpreted as "checked"
 * - For Radio buttons, use the 'name' property of the group in the selector, eg.: $("input[name=countrySelect]").fillwith('Belgium');
 * - Each options in a "Select" elements must have a "value" attribute
 *
 *
 * This source file is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 *
 * =================================================== */

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