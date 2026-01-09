#!/usr/bin/env php
<?php

declare(strict_types=1);

$projectRoot = getcwd(); // when executed from app, this is app root

$vendorSourcePhpmd = $projectRoot . '/vendor/maarsson/coding-standard/resources/phpmd.xml.dist';
$targetPhpmd = $projectRoot . '/phpmd.xml';

if (! file_exists($vendorSourcePhpmd)) {
    fwrite(STDERR, "Source file not found: {$vendorSourcePhpmd}\n");
    exit(1);
}

if (! copy($vendorSourcePhpmd, $targetPhpmd)) {
    fwrite(STDERR, "Failed to copy phpmd.xml to project root.\n");
    exit(1);
}

$vendorSourcePhpCs = $projectRoot . '/vendor/maarsson/coding-standard/resources/phpcs.xml.dist';
$targetPhpCs = $projectRoot . '/phpcs.xml';

if (! file_exists($vendorSourcePhpCs)) {
    fwrite(STDERR, "Source file not found: {$vendorSourcePhpCs}\n");
    exit(1);
}

if (! copy($vendorSourcePhpCs, $targetPhpCs)) {
    fwrite(STDERR, "Failed to copy phpcs.xml to project root.\n");
    exit(1);
}

fwrite(STDOUT, "Coding standard rulesets are applied to project.\n");
exit(0);
