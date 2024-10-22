<?php
session_start();

if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();
}


function listFilesAndFolders($dir)
{

    $scan = scandir($dir);


    echo "<h2>Current Directory: " . realpath($dir) . "</h2>";


    if (realpath($dir) !== realpath(__DIR__)) {
        echo "<a href='?dir=" . urlencode(dirname($dir)) . "'>Go Back to Previous Folder</a><br><br>";
    }

    echo "<ul>";


    foreach ($scan as $file) {
        // Skip the current directory (.) and parent directory (..)
        if ($file === '.' || $file === '..') {
            continue;
        }

        // Create full path for the current file/folder
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;


        if (is_dir($filePath)) {
            echo "<li><a href='?dir=" . urlencode($filePath) . "'>📁 $file</a></li>";
        } else {
            echo "<li><a href='$filePath' target='_blank'>📄 $file</a> <a href='$filePath' download>(Download)</a></li>";
        }
    }
    echo "</ul>";
}


$base_dir = __DIR__ . '/CS611Notes'; // Set the base directory to 'CS611Notes'


$dir = isset($_GET['dir']) ? realpath($_GET['dir']) : $base_dir;


if (strpos($dir, realpath($base_dir)) !== 0) {
    $dir = $base_dir;
}


listFilesAndFolders($dir);

?>