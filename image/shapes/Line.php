<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use InvalidArgumentException;
use position\Vector2;
use function imageline;

class Line extends BaseShape {
	
	public function __construct(?Vector2 $beginPos = null, private ?Vector2 $endPos = null, private int $size  = 1, ?Color $color = null) {
		parent::__construct($beginPos, $color);
		if ($this->getBeginPos()->getX() !== $this->getEndPos()->getX() and $this->getBeginPos()->getY() !== $this->getEndPos()->getY())
			throw new InvalidArgumentException("Cannot create a line with completely different coordinates!");
	}
	
	/**
	 * @return Vector2|null
	 */
	public function getEndPos(): ?Vector2 {
		return $this->endPos;
	}
	
	/**
	 * @return Vector2
	 */
	public function getBeginPos(): Vector2 {
		return parent::getPadding();
	}
	
	public function draw(GdImage $image): void {
		if ($this->getBeginPos()->getX() < $this->getEndPos()->getX()) {
			$size = ($this->getEndPos()->getX() - $this->getBeginPos()->getX());
			for ($i = $this->getBeginPos()->getX(); $i < $this->getEndPos()->getX(); $i++) {
				imageline($image, $i, ($this->getBeginPos()->getY() - $this->size), $i, $this->getEndPos()->getY(), $this->getColor()->getColor($image, $i, $size));
			}
		} else {
			$size = ($this->getEndPos()->getY() - $this->getBeginPos()->getY());
			for ($i = $this->getBeginPos()->getY(); $i < $this->getEndPos()->getY(); $i++) {
				imageline($image, ($this->getBeginPos()->getX() - $this->size), $i, $this->getEndPos()->getX(), $i, $this->getColor()->getColor($image, $i, $size));
			}
		}
	}
}