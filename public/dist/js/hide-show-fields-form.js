$("#seeAnotherFieldInstance").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldDivInstance').show();
        $('#otherField').attr('required','');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivInstance').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');				
    }
});
$("#seeAnotherFieldInstance").trigger("change");

$("#seeAnotherFieldClient").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldDivClient').show();
        $('#otherField').attr('required','');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivClient').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');				
    }
});
$("#seeAnotherFieldClient").trigger("change");

$("#seeAnotherFieldGroup").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldGroupDiv').show();
        $('#otherField1').attr('required','');
        $('#otherField1').attr('data-error', 'This field is required.');
$('#otherField2').attr('required','');
        $('#otherField2').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldGroupDiv').hide();
        $('#otherField1').removeAttr('required');
        $('#otherField1').removeAttr('data-error');
$('#otherField2').removeAttr('required');
        $('#otherField2').removeAttr('data-error');	
    }
});
$("#seeAnotherFieldGroup").trigger("change");
