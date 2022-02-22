$("#seeAnotherFieldInstance").change(function() {
    if ($('#instance_id').val() == "yes") {
        $('#otherFieldDivInstance').show();
        $('#newnamainstansi').attr('required','');
        $('#newnamainstansi').attr('data-error', 'This field is required.');
        $('#newkotainstansi').attr('required','');
        $('#newkotainstansi').attr('data-error', 'This field is required.');
        $('#newjenisinstansi').attr('required','');
        $('#newjenisinstansi').attr('data-error', 'This field is required.');
        $('#otherFieldDivClient').show();
        $('#newnamaklien').attr('required','');
        $('#newnamaklien').attr('data-error', 'This field is required.');
        $('#newemailklien').attr('required','');
        $('#newemailklien').attr('data-error', 'This field is required.');
        $('#newnomorteleponklien').attr('required','');
        $('#newnomorteleponklien').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivInstance').hide();
        $('#newnamainstansi').removeAttr('required');
        $('#newnamainstansi').removeAttr('data-error');		
        $('#newkotainstansi').removeAttr('required');
        $('#newkotainstansi').removeAttr('data-error');		
        $('#newjenisinstansi').removeAttr('required');
        $('#newjenisinstansi').removeAttr('data-error');
        $('#otherFieldDivClient').hide();
        $('#newnamaklien').removeAttr('required');
        $('#newnamaklien').removeAttr('data-error');				
        $('#newemailklien').removeAttr('required');
        $('#newemailklien').removeAttr('data-error');				
        $('#newnomorteleponklien').removeAttr('required');
        $('#newnomorteleponklien').removeAttr('data-error');		
    }
});
$("#seeAnotherFieldInstance").trigger("change");



$("#seeAnotherFieldClient").change(function() {
    if ($('#client_id').val() == "yes") {
        $('#otherFieldDivClient').show();
        $('#newnamaklien').attr('required','');
        $('#newnamaklien').attr('data-error', 'This field is required.');
        $('#newemailklien').attr('required','');
        $('#newemailklien').attr('data-error', 'This field is required.');
        $('#newnomorteleponklien').attr('required','');
        $('#newnomorteleponklien').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDivClient').hide();
        $('#newnamaklien').removeAttr('required');
        $('#newnamaklien').removeAttr('data-error');				
        $('#newemailklien').removeAttr('required');
        $('#newemailklien').removeAttr('data-error');				
        $('#newnomorteleponklien').removeAttr('required');
        $('#newnomorteleponklien').removeAttr('data-error');				
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