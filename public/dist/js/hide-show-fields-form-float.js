$("#seeAnotherFieldInstanceFt").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldDivInstanceFt').show();
        $('#otherField').attr('required','');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivInstanceFt').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');				
    }
});
$("#seeAnotherFieldInstanceFt").trigger("change");

$("#seeAnotherFieldClientFt").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldDivClientFt').show();
        $('#otherField').attr('required','');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivClientFt').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');				
    }
});
$("#seeAnotherFieldClientFt").trigger("change");