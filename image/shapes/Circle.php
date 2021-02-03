<?php

namespace image\shapes;

use image\color\Color;
use position\Vector2;

class Circle extends BaseShape {
	/** @var int $size */
	protected $size;
	/** @var bool $filled */
	protected $filled = false;
	
	public function __construct(?Vector2 $padding, ?Color $color, int $size = 200, bool $filled = false) {
		$this->size = $size;
		$this->filled = $filled;
		parent::__construct($padding, $color);
	}
	
	/**
	 * @return int
	 */
	public function getSize(): int {
		return $this->size;
	}
	
	/**
	 * @param $image
	 *
	 * @return mixed|void
	 */
	public function draw(&$image) {
		$ellipse = new Ellipse($this->getPadding(), $this->getColor(), $this->getSize(), $this->getSize(), $this->filled);
		$ellipse->draw($image);
	}
}