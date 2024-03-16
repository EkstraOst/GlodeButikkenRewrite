BACKEND:
Database fungerer som den skal så langt - 95% av koden lagt inn.

    TODO: Design og styling må ferdiggjøres - CSS kontrolleres

    TODO: Mulighet for å oppdatere ordrelinjene i vogn - backend

    TODO: Kontaktskjema. Modal-dialog?

    TODO: Bilder

    TODO: Admin-panel. Bruker bootstrap så fin øving for de fleste - bootstrap er et mulig alternativ på fremtidige sider vi lager.

Prøv ut siden og se om dere finner noen feil - gjerne rapporter på trello på bug



# Navngivings system og kommentarer:
 - alle klasse og mappe navn: camelCase og kebab-case 
 - Husk å legge inn kommentarer: en som en overskrift for hva koden gjør eks= <!-- HEADER STYLING -->, og en for hvem som har kodet <!-- kodet av "Navn" -->

 - Sorter Media Queries i alle css filer i STOR- LITEN rekkefølge!

 # Vi må få samlet mapper og ordne struktur før siden kan regnes som ferdig. 
  - Eg har begynt på dette, mens eg syr sammen koden - Polly
  - Alle bilder skal i systematiserte mapper i Assets mappen, ordne linker til bildene i html når man flytter bilden for å unngå rot.



# !NB! - samling fra branch til Merge:
 - Når man samler til Main fra de forskjellige branchene er det viktig å holde kontroll på om mappe systemene samsvarer eller om det trengs endringer, slik at alle linkene er funksjonable. 
 - Husk å redigere styling av tekst/link-tekst button i landing page html.
 - Fix splash bilde margin og height(slik at det ser mindre strekt ut)!!!!!
 - imageanimation skal flyttes over i produkter, lurt å finne ut før det flyttes om det skal plasseres ved hver enkelt produkt eller om det skal legges i produkt mappen generelt.
 - Legg til klassenavn til elementer som er stylet uten klasse. Polly fix (eks, elemeneter under .infoText trenger classe!)
 - Finn ut hvilke class/css fil som kontrollerer størrelsen på navBar/header.
 - skulle handlekurv ikonet vært hvitt?

- Har lagt inn styling av header og footer i HandleKurv mappen, som en midlertidig visning slik at det er lett å legge in template koden av handlekurven.

- Note to self: 
    - Tiril sin kode til eksempel template er til HP pro book 650.  .-DONE
    - Add footer til Sandra sin kode.  .-DONE, but needs adjusting!!
    - Hvorfor er ikke søke ikonet synlig?? -> manglet script, FIXED   .-DONE
    - Add Trym alt fra sin kode om OM OSS   .-DONE!!
    - Add Øystein alt fra Øystein sin kode fra Sikker sletting.   .-DONE,  media queries?
    - Mulig at Media qeuries i stylePl css filen må sorteres fra litens skjerm til stort
    - juster enten logo eller størrelse på Header/navBar!  .-DONE
    - Hvorfor er footeren misplassert i OMOSS siden? 
    - Er det ny footer fra Sandra?   .-NOPE, misforståelse.
    - I AboutPage: Fiks åpningstider til å være satt opp som ul, uten list-style(alstå uten de dottene forran).
    - I product list må produktene som vises enten plasseres med flex/gap eller i en grid, når vi bruker margin er det lett for at diverse nettlesere og skjermstørrelser ikkje reagerer likt.   .- DONE
    - fullt kaos i OmOss siden når den kom inn i main, needs fixing
    - fullt kaos i HandleKurv når den ble plassert i main, her må css fixes til å passe reaktivt design/forskjellige skjermstørrelser.
    - Add css på Desk bildet i landing page!  .-DONE
    - Lag Root system for fargene og endre navn på farger slik at alt samsvarer i hele prosjektet!  .-Tiril har lagt opp Root, nå må det bare implementeres i resten av css filene.
    - LandingPage.html må endres til index.html, dette er den eneste html filen som kan hete index.html.  .-DONE
    - Oppdater css for Logo.     .-DONE(?)
    - Fix Dark mode i handleKurv  .-DONE
    - ProductList -> koble til Tiril sin product template!!  .-DONE
    - Hvordan får vi darkmode til å forbli aktivert når man bytter side? - Tony Fix: DONE
    - sorter css i PL, gi class names til elementer og style accordingly. 
    - Oppdater Amalie sin css på Animert tekst.  + logo update!
    - oppdater Tiril og Trym sin kode! .-DONE
    - alt attribute tekst på ordnes/oppdateres til å beskrive bildene slik at det er tilrettelagt for blinde!
    - OMOSS: gi button et class name!!
    - Fix dropdown meny: legge tjenester under produkter m/sikkersletting(dette kan gjøres i template mappen)
    - Fått info for Sikker sletting via email, kun tekst er relevant til siden.
    - Sett opp system for bilder(spesifikt produkter!) og ordne mappe system genrelt, få alle sider under en mappe som heter Pages.




# js fra første utgave av landing page:

document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    let form = document.querySelector('form');

    // Add a submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the values from the form fields
        let rating = document.getElementById('yourInput').value;
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;

        // Log the values to the console
        console.log("Din vudering: " + rating);
        console.log("Navn: " + name);
        console.log("E-post: " + email);

        // You can also send this data to a server using AJAX if needed

        // Reset the form if necessary
        form.reset();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    let quantityInput = document.getElementById('quantity');
    let form = document.getElementById('cartForm');

    // Add event listener for changes in quantity
    quantityInput.addEventListener('input', function () {
        // You can perform actions here, e.g., update total price
        updateTotalPrice();
    });

    // Function to update total price (replace this with your logic)
    function updateTotalPrice() {
        // Example: Get quantity value and calculate total price
        let quantity = parseInt(quantityInput.value);
        let unitPrice = 10; // Replace with your actual unit price
        let totalPrice = quantity * unitPrice;

        // Display or use the total price as needed
        console.log('Total Price: $' + totalPrice);
    }

    // Add other event listeners or functions as needed

    // Prevent the default form submission for demonstration purposes
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        // Perform your form processing logic here
        console.log('Form submitted!');
    });
});



# css fra første landing page:

.btn {
    border-radius: 4px;
    background-color: #fb5607;
    border: none;
  color: white;
  text-align: center;
  font-size: 32px;
  padding: 16px;
  width: 220px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 36px;
  box-shadow: 0 10px 20px -8px rgba(0, 0, 0, 7);
}

.btn {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
    border-radius: 25px;
}

.btn:after {
    content: ">>";
    position: absolute;
    opacity: 0;
    top: 14px;
    right: -20px;
    transition: 0.5s;
}

.btn:hover {
   padding-right: 24px;
   padding-left: 8px;
}

.btn:hover:after {
    opacity: 1;
    right: 10px;
}
.slide {
    position: absolute;
    display: block;
    top: 2em;
    width: 60%;
    font-size: 2em;
  
    animation-duration: 20s;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
  }
  
  .slide {
      animation-name: anim-1;
      animation-name: anim-2;
      animation-name: anim-3;
  }
  
  @keyframes anim-1 {
      0%, 8.3% { left: -100%; opacity: 0; }
      8.3%,25% { left: 25%; opacity: 1; }
      33.33%, 100% { left: 110%; opacity: 0;}
  }
  
  @keyframes anim-2 {
      0%, 33.33% { left: -100%; opacity: 0; }
      41.63%, 58.29% { left: 25%; opacity: 1; }
      66.66%, 100% { left: 110%; opacity: 0;}
  }
  
  @keyframes anim-1 {
      0%, 66.66% { left: -100%; opacity: 0; }
      74.96%, 91.62% { left: 25%; opacity: 1; }
      100% { left: 110%; opacity: 0;}
  }
