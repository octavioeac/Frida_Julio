<?php
include '../classes/Conn.php';
include '../classes/Observaciones.php';
include 'tildeReplace.php';

$obser = tildeReplace($_POST['obser']);
$folio = $_POST['folio'];
$usr = $_POST['usr'];
$ob = new NuObser($obser,$folio,$usr);