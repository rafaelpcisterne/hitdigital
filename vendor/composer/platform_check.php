<?php

// platform_check.php @generated by Composer

$issues = array();

if (!(PHP_VERSION_ID >= 70205)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 7.2.5". You are running ' . PHP_VERSION  .  '.';
}

$missingExtensions = array();
extension_loaded('ctype') || $missingExtensions[] = 'ctype';
extension_loaded('exif') || $missingExtensions[] = 'exif';
extension_loaded('fileinfo') || $missingExtensions[] = 'fileinfo';
extension_loaded('filter') || $missingExtensions[] = 'filter';
extension_loaded('gd') || $missingExtensions[] = 'gd';
extension_loaded('json') || $missingExtensions[] = 'json';
extension_loaded('mbstring') || $missingExtensions[] = 'mbstring';
extension_loaded('pcre') || $missingExtensions[] = 'pcre';
extension_loaded('pdo') || $missingExtensions[] = 'pdo';
extension_loaded('simplexml') || $missingExtensions[] = 'simplexml';

if ($missingExtensions) {
    $issues[] = 'Your Composer dependencies require the following PHP extensions to be installed: ' . implode(', ', $missingExtensions);
}

if ($issues) {
    echo 'Composer detected issues in your platform:' . "\n\n" . implode("\n", $issues);
    exit(104);
}
