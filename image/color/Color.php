<?php

namespace image\color;

use function ctype_xdigit;
use function hexdec;
use function is_int;
use function str_replace;
use function strlen;

abstract class Color {
	
	abstract public function isSingleColored(): bool;
	
	/**
	 * Returns the color at a specific location
	 *
	 * @internal
	 *
	 * @param $image
	 * @param int $i important for multicolored classes such as Gradient
	 * @param int $size important for multicolored classes such as Gradient
	 *
	 * @return false|int
	 */
	abstract public function getColor($image, int $i, int $size);
	
	/**
	 * Returns a color number by a hex, might be used in future versions
	 *
	 * @param string $hex
	 *
	 * @return int|null
	 */
	public static function fromString(string $hex): ?int {
		if (strlen($hex) === 6 or (strlen($hex) === 7 and $hex[0] === "#")) {
			$hex = str_replace("#", "", $hex);
			if (!ctype_xdigit($hex)) return null;
			$val = hexdec(str_replace("#", "", $hex));
			if (!is_int($val)) return null;
			return $val;
		}
		return null;
	}
}