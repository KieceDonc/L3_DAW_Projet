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

/**
 * Find cookie parameters by its name
 * @param name
 */

function readCookie(name) {
  var cookieName = name + "=";
  var cookieFind = document.cookie.split(';');
  for(var i=0;i < cookieFind.length;i++) {
    var currentCookie = cookieFind[i];
    while (currentCookie.charAt(0)==' ') currentCookie = currentCookie.substring(1,currentCookie.length);
    if (currentCookie.indexOf(cookieName) == 0)
      return currentCookie.substring(cookieName.length,currentCookie.length);
  }
  return null;
}


/**
 * Script use for switch into light mode and dark mode
 */

let buttonState = 0;

var cssLink = $("<link>");
$("head").append(cssLink); 

function changeTheme() {
    //page load for first time, load light mode
    if(readCookie("themes") == "light" && buttonState == 0)
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/lightMode.css"
        });
        buttonState = 1;
        document.cookie = 'themes=light;';
    }
    //page has already load, and change mode by the button click
    else if(readCookie("themes") == "light" && buttonState == 1)
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/darkMode.css"
        });
        buttonState = 1;
        document.cookie = 'themes=dark;';
    }
    //page load for first time, load dark mode
    else if(readCookie("themes") == "dark" && buttonState == 0)
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/darkMode.css"
        });
        buttonState = 1;
        document.cookie = 'themes=dark;';
    }
    //page has already load, and change mode by the button click
    else 
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/lightMode.css"
        });
        buttonState = 1;
        document.cookie = 'themes=light;';
    }
}

window.onload = changeTheme();