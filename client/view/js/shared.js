/**
 * Execute code when DOM is loaded
 */
document.addEventListener("DOMContentLoaded", ()=> {
  underlineHeaderItems();
});


/**
 * underline <a> tag of header
 */
function underlineHeaderItems(){

  let items = [].slice.call(document.getElementsByClassName("nav__item"));
  items.forEach((HTMLElement)=>{
    underlineElementOnHover(HTMLElement)
  });

  underlineElementOnHover(document.getElementById("header-button"));
}

/**
 * Handle underline on HTMLElement on mouse o ver/out
 * @param {HTMLElement} element 
 */
function underlineElementOnHover(element){

  element.addEventListener("mouseover",()=>{
    element.style.textDecoration="underline"
  })

  element.addEventListener("mouseout",()=>{
    element.style.textDecoration=""
  })
}

/*
 * Script use for switch into light mode and dark mode
 */

let buttonState = 0;

var cssLink = $("<link>");
$("head").append(cssLink); 
//test
function changeTheme() {
    if(buttonState == 0)
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/lightFile.css"
        });
        buttonState = 1;
    }
    else
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/darkFile.css"
        });
        buttonState = 0;
    }
}

window.onload = changeTheme();