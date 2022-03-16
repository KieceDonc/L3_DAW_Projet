$(document).ready(() => {
    Choice();
    ValidChoice();
})

var choice=0;
var choiceConfirm =0;

function Choice()
{
    $(" .choice-text").on("click",function(event){
        ResetColor();
        $(this).closest(" .choice-container").css("background-color","#2B3B68");
        choice=($(this).attr('data-number'));
    })
}

function ResetColor(){
    $(" .choice-container").css("background-color","#F3F5F7");
}

function ValidChoice(){
    $(" .choice-valid").on("click",function(event){
        choiceConfirm = choice;
        choice = 0;
        ResetColor();
        console.log("Vous avez selectionner la reponse "+choiceConfirm);
        
    })
}