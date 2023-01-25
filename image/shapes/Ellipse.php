<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use position\Vector2;
use function imageellipse;
use function imagefilledellipse;

class Ellipse extends BaseShape {
	
	public function __construct(?Vector2 $padding = null, ?Color $color = null, private int $width = 300, private int $height = 300, private bool $filled = false) {
		parent::__construct($padding, $color);
	}
	
	/**
	 * @return int
	 */
	public function getWidth(): int {
		return $this->width;
	}
	
	/**
	 * @return int
	 */
	public function getHeight(): int {
		return $this->height;
	}
	
	public function draw(GdImage $image): void {
		if ($this->filled) {
			imagefilledellipse($image, ($this->getPadding()->getX() + ($this->getWidth() / 2)), ($this->getPadding()->getY() + ($this->getHeight() / 2)), $this->getWidth(), $this->getHeight(), $this->getColor()->getColor($image, 0, $this->getWidth()));
		} else {
			imageellipse($image, ($this->getPadding()->getX() + ($this->getWidth() / 2)), ($this->getPadding()->getY() + ($this->getHeight() / 2)), $this->getWidth(), $this->getHeight(), $this->getColor()->getColor($image, 0, $this->getWidth()));
		}
	}
}