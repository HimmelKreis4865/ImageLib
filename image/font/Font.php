<?php

namespace image\font;

use image\color\components\RGB;
use position\Vector2;
use function imagecolorallocate;

interface Font {
	
	/**
	 * A various text containing the content of the text
	 *
	 * @api
	 *
	 * @return string
	 */
	public function getText(): string;
	
	/**
	 * Returns the font size of the text, number between 1-5 followed after Latin-2
	 *
	 * @api
	 *
	 * @return float
	 */
	public function getFontSize(): float;
	
	/**
	 * Returns the padding (from top left)
	 *
	 * @api
	 *
	 * @return Vector2
	 */
	public function getPadding(): Vector2;
	
	/**
	 * Returns the color, will be converted to int @see imagecolorallocate()
	 *
	 * @api
	 *
	 * @return RGB
	 */
	public function getColor(): RGB;
}