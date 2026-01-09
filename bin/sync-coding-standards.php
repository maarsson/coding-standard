#!/usr/bin/env php
<?php

declare(strict_types=1);

$projectRoot = getcwd(); // when executed from app, this is app root
$vendorSource = $projectRoot . '/vendor/maarsson/coding-standard/resources/phpmd.xml.dist';
$target = $projectRoot . '/phpmd.xml';

if (! file_exists($vendorSource)) {
    fwrite(STDERR, "Source file not found: {$vendorSource}\n");
    exit(1);
}

if (! copy($vendorSource, $target)) {
    fwrite(STDERR, "Failed to copy phpmd.xml to project root.\n");
    exit(1);
}

fwrite(STDOUT, "Coding standard rulesets are applied to project.\n");
exit(0);
