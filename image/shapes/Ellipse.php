<?php

namespace image\shapes;

use image\color\Color;
use position\Vector2;
use function imageellipse;
use function imagefilledellipse;

class Ellipse extends BaseShape {
	
	protected $width;
	
	protected $height;
	
	protected $filled;
	
	public function __construct(?Vector2 $padding = null, ?Color $color = null, int $width = 300, int $height = 300, bool $filled = false) {
		$this->width = $width;
		$this->height = $height;
		$this->filled = $filled;
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
	
	/**
	 * @param $image
	 *
	 * @return mixed|void
	 */
	public function draw(&$image) {
		switch ($this->filled) {
			case true:
				imagefilledellipse($image, ($this->getPadding()->getX() + ($this->getWidth() / 2)), ($this->getPadding()->getY() + ($this->getHeight() / 2)), $this->getWidth(), $this->getHeight(), $this->getColor()->getColor($image, 0, $this->getWidth()));
				break;
			case false:
				imageellipse($image, ($this->getPadding()->getX() + ($this->getWidth() / 2)), ($this->getPadding()->getY() + ($this->getHeight() / 2)), $this->getWidth(), $this->getHeight(), $this->getColor()->getColor($image, 0, $this->getWidth()));
				break;
		}
	}
}