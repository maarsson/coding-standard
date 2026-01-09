<?php

declare(strict_types=1);

final class UnusedLocalVariable
{
    public function run(): int
    {
        $number = 123;

        return 456;
    }
}
