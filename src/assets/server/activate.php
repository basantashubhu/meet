<?php

include_once 'connect.php';

function setPk($value) {
    $phpContent = file_get_contents('connect.php');

    $pos = strpos($phpContent, '$setVal');

    if ($pos === false) {
        $phpContent .= '$setVal = \'\';';
    }

    $str = str_replace('$setVal = \'\';', '$setVal = \'' . $value . '\';', $phpContent);
    file_put_contents('connect.php', $str);
}

function zipFolder($folder, $folderName) {

    $rootPath = realpath($folder);

    $zip = new ZipArchive();
    if (file_exists($folderName)) {
        $newFolderName = explode('.zip', $folderName);
        $newFolder = $newFolderName[0] . '(1).zip';
    } else {
        $newFolder = $folderName;
    }
    $zip->open($newFolder, ZipArchive::CREATE);


    $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        $pos = strrpos($file->getFilename(), '.zip');
        if (!$file->isDir() && $pos === false) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }

    $zip->close();
}

function updateFiles($arr) {


    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/pages', $_SERVER['DOCUMENT_ROOT'] . '/pages/pages_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/css', $_SERVER['DOCUMENT_ROOT'] . '/css/css_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/locales', $_SERVER['DOCUMENT_ROOT'] . '/locales/locales_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/config', $_SERVER['DOCUMENT_ROOT'] . '/config/config_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/js', $_SERVER['DOCUMENT_ROOT'] . '/js/js_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/dash', $_SERVER['DOCUMENT_ROOT'] . '/dash/dash_' . date('Y-m-d_H-i') . '.zip');
    zipFolder($_SERVER['DOCUMENT_ROOT'] . '/admin', $_SERVER['DOCUMENT_ROOT'] . '/admin/admin_' . date('Y-m-d_H-i') . '.zip');



    $filesArray = json_decode($arr);
    $files = '';
    foreach ($filesArray as $key => $value) {
        $phpContent = file_get_contents($key);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . $value, $phpContent);
        $files .= $value . '<br/>';
    }
    echo $files;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] == 'setpk') {
        echo setPk($_POST['value']);
    }
    if (isset($_POST['type']) && $_POST['type'] == 'update') {
        echo updateFiles($_POST['value']);
    }
}
