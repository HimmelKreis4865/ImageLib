<?php

namespace image\shapes;

use image\color\Color;
use position\Vector2;
use function imageline;

class Square extends BaseShape {
	/** @var int $size */
	protected $size;
	
	/**
	 * Square constructor.
	 *
	 * @param Vector2|null $padding
	 * @param int $size
	 * @param Color|null $color
	 */
	public function __construct(?Vector2 $padding = null, int $size = 300, ?Color $color = null) {
		$this->size = $size;
		parent::__construct($padding, $color);
	}
	
	/**
	 * @param $image
	 *
	 * @return void
	 */
	public function draw(&$image) {
		for ($i = $this->getPadding()->getY(); $i < ($this->size + $this->getPadding()->getY()); $i++) {
			imageline($image, $this->getPadding()->getX(), $i, ($this->size + $this->getPadding()->getX()), $i, $this->getColor()->getColor($image, $i, ($this->getPadding()->getY() + $this->size)));
		}
	}
}