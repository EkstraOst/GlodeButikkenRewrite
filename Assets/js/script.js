// Check for existing theme in Local Storage
//Kodet av Tony
document.addEventListener('DOMContentLoaded', function() {
  const savedTheme = localStorage.getItem('theme');
  const body = document.body;
  const modeToggle = document.querySelector('.mode-toggle');
  let circle = document.querySelector('.circle');

  if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
    body.classList.toggle('dark-mode', savedTheme === 'dark');
    circle.classList.toggle('dark-mode', savedTheme === 'dark');
    body.style.backgroundColor = savedTheme === 'dark' ? '#222' : '#fff';
  }
  // Remove transition class on page load
  body.classList.remove('transition-theme');
});

// search-box open close js code
//Kodet av Sandra
let navbar = document.querySelector(".navbar");
let searchBox = document.querySelector(".search-box .bx-search");
// let searchBoxCancel = document.querySelector(".search-box .bx-x");

searchBox.addEventListener("click", ()=>{
  navbar.classList.toggle("showInput");
  if(navbar.classList.contains("showInput")){
    searchBox.classList.replace("bx-search" ,"bx-x");
  }else {
    searchBox.classList.replace("bx-x" ,"bx-search");
  }
});

// sidebar open close js code
let navLinks = document.querySelector(".nav-links");
let menuOpenBtn = document.querySelector(".navbar .bx-menu");
let menuCloseBtn = document.querySelector(".nav-links .bx-x");
menuOpenBtn.onclick = function() {
navLinks.style.left = "0";
}
menuCloseBtn.onclick = function() {
navLinks.style.left = "-100%";
}


// sidebar submenu open close js code
let htmlcssArrow = document.querySelector(".htmlcss-arrow");
htmlcssArrow.onclick = function() {
 navLinks.classList.toggle("show1");
}
let moreArrow = document.querySelector(".more-arrow");
moreArrow.onclick = function() {
 navLinks.classList.toggle("show2");
}
/*
let jsArrow = document.querySelector(".js-arrow");
jsArrow.onclick = function() {
 navLinks.classList.toggle("show3");
}


/* Kodet av Amalie og Tony*/
/* LIGHT AND DARK MODE */

function toggleMode() {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';

  document.documentElement.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  
  const body = document.body;
  const circle = document.querySelector('.circle');

  // Add transition class only when toggling mode
  body.classList.add('transition-theme');

  body.classList.toggle('dark-mode');
  circle.classList.toggle('dark-mode');

  body.style.backgroundColor = body.classList.contains('dark-mode') ? '#222' : '#fff';

  // Remove transition class after the transition completes
  setTimeout(function() {
    body.classList.remove('transition-theme');
  }, 1000); // Adjust the time according to your transition duration
}




//bjørnar

//enter = søk i søkebar
//starter index-siden med instruksjoner om å vise søkeresultater (page=2) og søketype er fritekst (type=3)
//og teksten som skal søkes etter er node.value (para=...)
const node = document.getElementById("searchbar");
node.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
      alert(node.value);
      window.location.assign("index.php?page=2&type=3&param=" + node.value);
    }
});

//hvert produktkort får lagt inn spesifikt funksjonskall så "legg i vogn"-knappen vet hvilket av kortene som har blitt trykt på
//Hver button vil ha value = produkt-id til produktet de representerer.
//Så legger inn et kall til leggivogn() med det tallet som parameter. leggivogn(11) f.eks.
const collection = document.getElementsByClassName("leggivogn");
for (const btn of collection) {
    btn.onclick = function() {
        leggivogn(btn.value);
    }
}


//Denne funksjonen sjekker ut en liten nettside i skjul. (ajax_leggivogn.php?pid=$produktID)
//Den siden legger produktet i handlevognen i databasen, og sender et tall på
//hvor mange produktor det nå er totalt i vognen. (...innerHTML = this.responseText...)
function leggivogn(produktid) {
    if (produktid == "") alert("ingen produktid sendt");
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("badge").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Assets/php/ajax_leggivogn.php?pid=" + produktid, true);
    xhttp.send();
}