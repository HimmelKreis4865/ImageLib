<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use position\Vector2;

class Circle extends BaseShape {
	
	/**
	 * @param Vector2|null $padding
	 * @param Color|null $color
	 * @param int $size
	 * @param bool $filled
	 */
	public function __construct(?Vector2 $padding, ?Color $color, protected int $size = 200, protected bool $filled = false) {
		parent::__construct($padding, $color);
	}
	
	/**
	 * @return int
	 */
	public function getSize(): int {
		return $this->size;
	}
	
	public function draw(GdImage $image): void {
		$ellipse = new Ellipse($this->getPadding(), $this->getColor(), $this->getSize(), $this->getSize(), $this->filled);
		$ellipse->draw($image);
	}
}