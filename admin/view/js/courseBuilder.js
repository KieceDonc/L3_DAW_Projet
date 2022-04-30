$("#nametxt").keyup(function (e) { 
    checkEnabled()
});

$("#desctxt").keyup(function (e) { 
    checkEnabled()
});

function checkEnabled(){
    if( $("#nametxt").val().length >= 3 && $("#nametxt").val().length <= 100 && $("#desctxt").val().length >= 3 && $("#desctxt").val().length <= 2000 )
        $("#submitbtn").attr("disabled", false);
    else
        $("#submitbtn").attr("disabled", true); 
}