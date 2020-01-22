<?php
// Author: Andrew Afonso
// Downloads the NSIC calendar event file
$file = 'NSIC.ics';
if (file_exists($file)) {
    header('Content-Description: NSIC Calendar Event');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?> 
