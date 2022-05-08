$(document).ready(() => {
    Choice();
});

var choice=0;
var choiceConfirm =0;
var NumQuestion = 1;
var numChoice=1;

function Choice()
{
    $(" .choice-text").on("click",function(event){

        choice=($(this).attr('id'));
        numberQ=($(this).attr('numberQ'));

        $(this).closest(".question").find(" .choice-container").css("background-color","#F3F5F7");

        $(this).closest(" .choice-container").css("background-color","#2B3B68");
        
        $(this).closest(".question").find(".choice-input").val(choice);
        $(this).closest(".question").find(".choice-valid").text("Selected answer : " + choice);
    })
}





