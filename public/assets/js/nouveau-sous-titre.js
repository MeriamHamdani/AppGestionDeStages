$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID


    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row"><div class="col"><div class="mb-3"><label class="form-label" for="message-text">Sous-Titre</label><input type="text"></div></div><div class="col"><div class="mb-3"><label class="form-label" for="message-text">Barème</label><fieldset><div class="touchspin-vertical-tab"><input class="touchspin-vertical" type="text" value="0" /></div></fieldset></div><button class="btn btn-outline-danger remove_field" type="button">Retirer</button></div></div>');
            // $(wrapper).append('<div class="input-group mb-3"><input placeholder="entrer un autre sous titre" type="text" name="mytext[]" class="form-control"><div class="input-group-append"><button class="btn btn-outline-danger remove_field" type="button">Retirer</button></div></div>'); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        x--;
    })

});