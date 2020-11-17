<?php

/*
 *
 * This script will backup your web site by remotely archiving all files on the root FTP directory.
 * It will work even if your web server is memory limited buy splitting zips in several arhive files it they are too many files.
 * All zip files will be stored in a directory called temporary which must be writable.
 *
 * How to use it:
 * - Place the script at the root of your FTP.
 * - Call http://yoursite.com/zip.php
 * - In your FTP client go to temporary folder and download all backup_xxxxxx_x.zip files locally
 * - Unzip everything with this command: for i in *.zip; do unzip $i; done;
 * - Finally to avoid security issues, remove the script from the FTP.
 * 
 * jonathan.maim@gmail.com
 * 
 */

// increase script timeout value
ini_set('max_execution_time', 5000);

function show($str){
   echo $str . "<br/>\n";
   flush();
   ob_flush();
}

$date = getdate();
$splitNum = 0;

$archive = "temporary/backup_" . $date[0];
$currentArchive = $archive . "_" . $splitNum . ".zip";

$zip = new ZipArchive();
if ($zip->open($currentArchive, ZIPARCHIVE::CREATE) !== TRUE) {
    die ("Could not open archive");
}

$numFiles = 0;
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./"));
foreach ($iterator as $key=>$value){
   $numFiles += 1;
}
show( "Will backup $numFiles to $archive.zip" );

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./"));
$numFiles = 0;
$counter = 0;
$maxFilePerArchive = 1000;
foreach ($iterator as $key=>$value){
   $counter += 1;
   if ($counter >= $maxFilePerArchive) {
      $currentArchive = $archive . "_" . $splitNum++ . ".zip";
      show( "Too many files: splitting archive, new archive is $currentArchive" ); 
      $zip->close();
      $zip = new ZipArchive();
      if ($zip->open($currentArchive, ZIPARCHIVE::CREATE) !== TRUE) {
          die ("Could not open archive");
      }
      $counter = 0;
   }
   //$i = $maxFilePerArchive*$splitNum + $counter; 
   if (! preg_match('/temporary\/backup_' . $date[0] . '/', $key)){
      $zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
      $numFiles += 1;
      if ($numFiles % 300 == 0) {
         show( "$numFiles" );
      }
   } else {
      show( "Not backuping this file -> $key" );
   }
}
// close and save archive
$zip->close();
show( "Archive created successfully with $numFiles files." );

?>

