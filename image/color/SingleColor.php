<?php

namespace image\color;

use image\color\components\RGB;
use function imagecolorallocate;

class SingleColor extends Color {
	/** @var RGB $color */
	protected $color;
	
	/**
	 * SingleColor constructor.
	 *
	 * @param RGB $color
	 */
	public function __construct(RGB $color) {
		$this->color = $color;
	}
	
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
	 * @param $image
	 * @param int $i not important here, but still needed
	 * @param int $size not important here, but still needed
	 *
	 * @return false|int
	 */
	public function getColor($image, int $i, int $size) {
		return imagecolorallocate($image, $this->color->getRed(), $this->color->getGreen(), $this->color->getBlue());
	}
}