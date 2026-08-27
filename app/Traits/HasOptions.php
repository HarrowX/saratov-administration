<?php

namespace App\Traits;

trait HasOptions
{
    abstract public function getLabel(): string;

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->getLabel();
        }

        return $options;
    }
}
