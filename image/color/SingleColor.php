<?php

namespace image\color;

use GdImage;
use image\color\components\RGB;
use function imagecolorallocate;

class SingleColor extends Color {
	
	/**
	 * SingleColor constructor.
	 *
	 * @param RGB $color
	 */
	public function __construct(private RGB $color) { }
	
	/**
	 * Returns whether its a single color or consists of more than one color
	 *
	 * @internal
	 *
	 * @return bool
	 */
	public function isSingleColored(): bool {
		return true;
	}
	
	/**
	 * Returns the color at a specific location (doesn't matter here due to same color anyways)
	 *
	 * @internal
	 *
	 * @param GdImage $image
	 * @param int $i not important here, but still needed
	 * @param int $size not important here, but still needed
	 *
	 * @return false|int
	 */
	public function getColor(GdImage $image, int $i, int $size): false|int {
		return imagecolorallocate($image, $this->color->getRed(), $this->color->getGreen(), $this->color->getBlue());
	}
}