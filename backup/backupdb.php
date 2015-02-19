<?php
include "DropboxUploader.php";
include_once "../configuration.php";
$dbHost = $mosConfig_host;
$dbUser = $mosConfig_user;
$dbPass = $mosConfig_password;
$dbName = $mosConfig_db;

function ExportDB($dbHost, $dbUser, $dbPass, $dbName) {
  $command = "mysqldump --opt --host=$dbHost --user=$dbUser --password=$dbPass --databases $dbName > $dbName.sql";
  system($command);
}

function TransferDB($dbName) {
  $uploader = new DropboxUploader('info@remedicreative.com', 'pleasant');
  $uploader->upload("$dbName.sql", 'Backups');
}

ExportDB($dbHost, $dbUser, $dbPass, $dbName);
TransferDB($dbName);

// To set a cron job on JaguarPC:
// php -f /home/remediho/public_html/quickcareauto/backup/backupdb.php
?>