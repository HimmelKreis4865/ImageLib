<?php

namespace image\shapes;

use image\color\Color;
use position\Vector2;
use function imageline;

class Rectangle extends BaseShape {
	/** @var int $width */
	protected $width = 400;
	
	/** @var int $height */
	protected $height = 400;
	
	/**
	 * Rectangle constructor.
	 *
	 * @param Vector2|null $padding
	 * @param int $width
	 * @param int $height
	 * @param Color|null $color
	 */
	public function __construct(?Vector2 $padding = null, int $width = 400, int $height = 400, ?Color $color = null) {
		$this->width = $width;
		$this->height = $height;
		parent::__construct($padding, $color);
	}
	
	/**
	 * @param $image
	 *
	 * @return mixed|void
	 */
	public function draw(&$image) {
		for ($i = $this->getPadding()->getY(); $i < ($this->getPadding()->getY() + $this->height); $i++) {
			imageline($image, $this->getPadding()->getX(), $i, ($this->getPadding()->getX() + $this->width), $i, $this->getColor()->getColor($image, $i, ($this->getPadding()->getY() + $this->height)));
		}
	}
}