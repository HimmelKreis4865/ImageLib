<?php

namespace image\font;

use image\color\components\RGB;
use position\Vector2;

class BaseFont implements Font {
	
	/**
	 * BaseFont constructor.
	 *
	 * @param string $text
	 * @param int $fontSize can be between 1 and 5
	 * @param Vector2|null $padding
	 * @param RGB|null $color
	 */
	public function __construct(private string $text, private int $fontSize = 3, private ?Vector2 $padding = null, private ?RGB $color = null) { }
	
	/**
	 * Returns the content of the text
	 *
	 * @api
	 *
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}
	
	/**
	 * Returns the fontsize passed above
	 *
	 * @api
	 *
	 * @return float
	 */
	public function getFontSize(): float {
		return $this->fontSize;
	}
	
	/**
	 * Returns the padding, if null, it will return a new Vector2 at position 0, 0
	 *
	 * @api
	 *
	 * @return Vector2
	 */
	public function getPadding(): Vector2 {
		return $this->padding ?? new Vector2(0, 0);
	}
	
	/**
	 * Returns the color of the font or black in case it's null
	 *
	 * @api
	 *
	 * @return RGB
	 */
	public function getColor(): RGB {
		return $this->color ?? new RGB(0, 0, 0);
	}
}