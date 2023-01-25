<?php

namespace image\color\components;

interface ColorComponent {
    /**
     * Returns whether entered data or not
     *
     * @param mixed $data
     *
     * @return bool
     */
    public static function isValid(mixed $data): bool;
}