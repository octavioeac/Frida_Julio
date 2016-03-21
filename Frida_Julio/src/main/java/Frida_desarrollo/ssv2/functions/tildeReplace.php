<?php
function tildeReplace($word){
    trim($word);
    $or = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ü','Ü','ñ','Ñ');
    $en = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;',
            '&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;',
            '&uuml;','&Uuml;','&ntilde;','&Ntilde;');
    return str_replace($or, $en, $word);
}
function tildeDecode($word){
    trim($word);
    $or = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ü','Ü','ñ','Ñ');
    $en = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;',
            '&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;',
            '&uuml;','&Uuml;','&ntilde;','&Ntilde;');
    return str_replace($en, $or, $word);
}