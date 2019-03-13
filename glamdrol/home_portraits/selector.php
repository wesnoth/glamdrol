<?php
/*
 * Random image selector by Iris Morelle <shadowm@wesnoth.org>
 * This file is in public domain
 */

$d_entries = glob(dirname(__FILE__)."/*.jpg");
$index = rand(0,sizeof($d_entries)-1);
$d_entry = $d_entries[$index];

if(file_exists($d_entry)) {
    header('Content-type: image/jpeg');
    header('Pragma: no-cache');

    ob_clean();
    flush();
    readfile($d_entry);
}

exit;

?>
