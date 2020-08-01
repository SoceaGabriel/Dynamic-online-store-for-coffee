//functia pentru a face functia responsive
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "menu-bar") {
    x.className += " responsive";
  } else {
    x.className = "menu-bar";
  }
}

//functia de afisare a formularului de schimbare a parolei
function show_change_pass()
{
  x = document.getElementById('actualizare_parola');
  x.style.display = "block";
}

//functia de afisare a link-ului activ din meniu - nu functioneaza
var old_identif="";
function setActive(identif){
  var x=document.getElementById(identif);
  x.classList.replace("menu-link", "active");
  old_identif.classList.replace("active", "menu-link");
  old_identif = identif;
}
