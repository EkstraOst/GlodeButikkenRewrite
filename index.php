<?php 
session_set_cookie_params(60*60*24*14, '/; samesite='. "lax", $_SERVER['HTTP_HOST'], true);
session_start();
if (true) { error_reporting(E_ALL); ini_set('display_errors', '1'); } //DEBUG

/*
=================================== SETUP ===================================
*/
include("Assets/php/variables.php"); //VARIABLER
include("Assets/php/functions.php"); //FUNKSJONER

//DATABASETILKOBLING OG BRUKER
$con = mysqli_connect("glodedatano01.mysql.domeneshop.no", "glodedatano01", "Andre-nv-belma-9nx", "glodedatano01");
if (mysqli_connect_errno()) { exit(); }
giBrukerId($con); //skaff id-nummer til brukeren
antallVogn($con); //last inn antall varer i handlevogn

//SIDE-INNSTILLINGER. Validering av side-variabler
if (!isset($_SESSION['page'])) { $_SESSION['page'] = 1; }
if (!isset($_SESSION['type'])) { $_SESSION['type'] = 0; }
if (!isset($_SESSION['para'])) { $_SESSION['para'] = ".*"; }
$_SESSION['page'] = isset($_GET['page']) ? $_GET['page'] : $_SESSION['page'];
$_SESSION['type'] = isset($_GET['type']) ? $_GET['type'] : $_SESSION['type'];
$_SESSION['para'] = isset($_GET['para']) ? $_GET['para'] : $_SESSION['para'];
$side     = $_SESSION['page'];
$type     = $_SESSION['type'];
$para     = $_SESSION['para'];
$uid      = $_SESSION['id'];
$vogntall = $_SESSION['vogntall'];

/*
=================================== SETUP ===================================
Her settes siden sammen. Alt annet var bare settings og shit: headers + riktig innmat + footer
*/
include("Assets/templates/htmlheader.html");
include("Assets/templates/header.php");

if      ($side == 2)  include('Assets/page/soek.php');  
else if ($side == 3)  include('Assets/page/prod.php');  
else if ($side == 4)  include('Assets/page/vogn.php');  
else                  include('Assets/page/hjem.php'); 

include('Assets/templates/footer.php');
echo "</body></html>";