<?php

namespace image\color;

use image\color\components\RGB;
use function floor;
use function imagecolorallocate;

class Gradient extends Color {
	/** @var RGB $begin */
	protected $begin;
	
	/** @var RGB $end */
	protected $end;
	
	public function __construct(RGB $begin, RGB $end) {
		$this->begin = $begin;
		$this->end = $end;
	}
	
	/**
	 * Returns whether its a single color or consists of more than one color
	 *
	 * @internal
	 *
	 * @return bool
	 */
	public function isSingleColored(): bool {
		return false;
	}
	
	/**
	 * Returns the color at a specific location
	 *
	 * @internal
	 *
	 * @param $image
	 * @param int $i important to decide which color is actually needed
	 * @param int $size important to decide which color is actually needed
	 *
	 * @warning Might throw an exception because R/G/B values can become above 255 in some use cases
	 *
	 * @return false|int
	 */
	public function getColor($image, int $i, int $size) {
		return imagecolorallocate($image, (floor(($i * ($this->end->getRed() - $this->begin->getRed()) / $size)) + $this->begin->getRed()), (floor(($i * ($this->end->getGreen() - $this->begin->getGreen()) / $size)) + $this->begin->getGreen()), (floor(($i * ($this->end->getBlue() - $this->begin->getBlue()) / $size)) + $this->begin->getBlue()));
	}
}