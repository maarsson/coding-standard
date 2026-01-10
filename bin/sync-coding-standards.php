#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Mapping of ruleset files to be copied:
 *      source (inside package) => destination (in project root)
 *
 * @var array<string, string>
 */
const FILES_TO_SYNC = [
    'resources/phpmd.xml.dist' => 'phpmd.xml',
    'resources/phpcs.xml.dist' => 'phpcs.xml',
];

$projectRoot = getcwd(); // when executed from app, this is app root
$vendorRoot = $projectRoot . '/vendor/maarsson/coding-standard/';
$errorsCount = 0;

foreach (FILES_TO_SYNC as $source => $target) {
    $sourcePath = $vendorRoot . $source;
    $targetPath = $projectRoot . $target;

    if (! file_exists($sourcePath)) {
        fwrite(STDERR, "Source file not found at {$sourcePath}\n");
        $errorsCount++;
    }

    if (! copy($sourcePath, $targetPath)) {
        fwrite(STDERR, "Failed to copy {$target} to project root.\n");
        $errorsCount++;
    }
}

if ($errorsCount > 0) {
    fwrite(STDERR, "There were errors during the process.\n");
    exit(1);
}

fwrite(STDOUT, "Coding standard rulesets are applied to project.\n");
exit(0);
