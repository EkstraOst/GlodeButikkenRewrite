<?php
//Session er en spesiell cookie. Setter levetiden til 14 dager, og starter session.
//Når session starter ser den etter en nøkkel som ligger på maskinen til bruker.
//Har ikke personen besøkt siden blir ny session-cookie laget (og ny bruker senere i giBrukerId)
session_set_cookie_params(60*60*24*14, '/; samesite='. "lax", $_SERVER['HTTP_HOST'], true);
session_start();
if (true) { error_reporting(E_ALL); ini_set('display_errors', '1'); } //DEBUG - dette er grunnen til at feilmeldingene viser fra databasen.

/*
=================================== SETUP ===================================

*/
include("Assets/php/variables.php"); //VARIABLER
include("Assets/php/functions.php"); //FUNKSJONER

//DATABASETILKOBLING OG BRUKER
//Denne variablen er tilgjengelig for alt annet som skjer senere på siden;  produktvisning, handlevogn, søk osv
$con = mysqli_connect("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
if (mysqli_connect_errno()) { exit(); }
giBrukerId($con); //skaff id-nummer til brukeren. Lag ny om hen ikke har besøkt siden før (i.l.a siste 14 dager)
antallVogn($con); //last inn antall varer i handlevogn

//SIDE-INNSTILLINGER. Validering av side-variabler
//Disse variablene blir satt sånn: Trykker du på pc-kategorien i menyen f.eks så er linken:
//"index.php?page=2&type=1&para=2" - som betyr; page=2 er søkeside, type=1 søketype er "overkategori", para=2 er idnummeret til overkat
//som skal søkes etter.
//EX:
//"index.php?page=4" er handlevogn.
//"index.php?page=3&para=2" er produktside (her vises produktet med id 2 (para))
//"index.php?page=1" er landingpage
if (!isset($_SESSION['page'])) { $_SESSION['page'] = 1; }
if (!isset($_SESSION['type'])) { $_SESSION['type'] = 0; }
if (!isset($_SESSION['para'])) { $_SESSION['para'] = ".*"; }
$_SESSION['page'] = isset($_GET['page']) ? $_GET['page'] : $_SESSION['page'];
$_SESSION['type'] = isset($_GET['type']) ? $_GET['type'] : $_SESSION['type'];
$_SESSION['para'] = isset($_GET['para']) ? $_GET['para'] : $_SESSION['para'];
$side     = $_SESSION['page'];      //siden vi er på
$type     = $_SESSION['type'];      //typen søk (om relevant).
$para     = $_SESSION['para'];      //parameter.. det som skal søkes etter. Normalt sett en id
$uid      = $_SESSION['id'];        //brukerid (se giBrukerId)
$vogntall = $_SESSION['vogntall'];  //antall varer i vogn

/*
=================================== WEBSIDE-SNEKRING ===================================
Her settes siden sammen. Alt annet var bare settings og shit: headers + riktig innmat + footer
include() - denne funksjonen laster bare inn filen som om den hører til denne siden.
*/
include("Assets/templates/htmlheader.html");
include("Assets/templates/header.php");

if      ($side == 2)  include('Assets/page/soek.php');  
else if ($side == 3)  include('Assets/page/prod.php');  
else if ($side == 4)  include('Assets/page/vogn.php');
else if ($side == 5)  include('Assets/page/slet.php');
else                  include('Assets/page/hjem.php'); 

include('Assets/templates/footer.php');
echo "</body></html>";


