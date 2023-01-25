<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use position\Vector2;
use function imageline;

class Rectangle extends BaseShape {
	
	/**
	 * Rectangle constructor.
	 *
	 * @param Vector2|null $padding
	 * @param int $width
	 * @param int $height
	 * @param Color|null $color
	 */
	public function __construct(?Vector2 $padding = null, private int $width = 400, private int $height = 400, ?Color $color = null) {
		parent::__construct($padding, $color);
	}
	
	public function draw(GdImage $image): void {
		for ($i = $this->getPadding()->getY(); $i < ($this->getPadding()->getY() + $this->height); $i++) {
			imageline($image, $this->getPadding()->getX(), $i, ($this->getPadding()->getX() + $this->width), $i, $this->getColor()->getColor($image, $i, ($this->getPadding()->getY() + $this->height)));
		}
	}
}