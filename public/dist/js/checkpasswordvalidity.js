$("#pulang").change(function() {
    if($("#pulang").val() == $("#pbaru").val() ) {
        $('#pulang').removeAttr('data-error');
    }
    else {
        $("#pulang").attr('data-error','Password tidak sesuai dengan password baru!');
    }
});
$("#pulang").trigger("change");