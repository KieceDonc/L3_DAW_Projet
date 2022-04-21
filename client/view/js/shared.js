/**
 * Execute code when DOM is loaded
 */

$(document).ready(function () {

/**
 * underline <a> tag of header
 */
$(".nav__item, .header-button").hover(function(){
  $(this).css("textDecoration", "underline");
  },
  function(){
    $(this).css("textDecoration", "none");
    }
);

$("#language").on("change", function() {
  if(readCookie("lang") != this.value){
    document.cookie = 'lang=' + this.value +';';
    location.reload();
  }
});


/**
 * Script used to switch into light or dark mode
 */

loadTheme();

$("#switchBtn").click(changeTheme);
});

let buttonState = 0;
let cssLink = $("<link>");

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

function loadTheme(){
  $("head").append(cssLink); 

  //dark
  if(readCookie("theme") == "0") {
    buttonState = "0";
    cssLink.attr({
      rel:  "stylesheet",
      type: "text/css",
      href: "../css/darkMode.css"
    });

    $("#switchBtn").prop("checked", false);
  }
  else{
    //otherwise light
    buttonState = "1";
    cssLink.attr({
      rel:  "stylesheet",
      type: "text/css",
      href: "../css/lightMode.css"
    });

    $("#switchBtn").prop("checked", true);
  }
}

function changeTheme() {
    //load light mode
    if(buttonState == "0")
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/lightMode.css"
        });
        buttonState = "1";
    }//load dark mode
    else 
    {
        cssLink.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "../css/darkMode.css"
        });
        buttonState = "0";
    }

    document.cookie = 'theme=' + buttonState +';';
}