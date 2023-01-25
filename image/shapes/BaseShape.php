<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use image\color\components\RGB;
use image\color\SingleColor;
use position\Vector2;

abstract class BaseShape {
	
	/** @var Vector2 $padding */
	protected Vector2 $padding;
	
	/** @var Color $color */
	protected Color $color;
	
	public function __construct(?Vector2 $padding = null, ?Color $color = null) {
		$this->padding = $padding ?? new Vector2(0, 0);
		$this->color = $color ?? new SingleColor(new RGB(255, 255, 255));
	}
	
	/**
	 * Draws the shape on an image
	 *
	 * @api
	 *
	 * @param GdImage $image
	 *
	 * @return void
	 */
	abstract public function draw(GdImage $image): void;
	
	
	/**
	 * @return Color
	 */
	public function getColor(): Color {
		return $this->color;
	}
	
	/**
	 * @return Vector2
	 */
	public function getPadding(): Vector2 {
		return $this->padding;
	}
}