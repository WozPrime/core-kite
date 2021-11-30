$('#instansi_instance_id').change(function () {
    var selectedText = $(this).find("option:selected").text();
    
    $(".test").text(selectedText);
});