<?php

namespace image\font;

use image\color\components\RGB;
use InvalidArgumentException;
use position\Vector2;
use function file_exists;
use const DIRECTORY_SEPARATOR;

class ExtendedFont implements Font {
	/** @var string $text */
	protected $text;
	
	/** @var string $fontPath */
	protected $fontPath;
	
	/** @var float|int $fontSize */
	protected $fontSize;
	
	/** @var float $angle */
	protected $angle;
	
	/** @var Vector2|null $padding */
	protected $padding;
	
	/** @var RGB|null $color */
	protected $color;
	
	/**
	 * ExtendedFont constructor.
	 *
	 * @param string $text
	 * @param string $fontPath can either be a path you like or a predefined path (in /fonts/*.ttf) - You have to add the extension (.ttf)
	 * @param float|int $fontSize
	 * @param float $angle enter an angle of the font here, goes clockwise from top (0.0)
	 * @param Vector2|null $padding
	 * @param RGB|null $color
	 */
	public function __construct(string $text, string $fontPath,  float $fontSize = 3, float $angle = 0.0, ?Vector2 $padding = null, RGB $color = null) {
		if (!file_exists($fontPath)) {
			// todo: clean this up
			$fontPath = __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . $fontPath;
			if (!file_exists($fontPath)) throw new InvalidArgumentException("Could not find a font under name $fontPath");
		}
		$this->text = $text;
		$this->fontPath = $fontPath;
		$this->fontSize = $fontSize;
		$this->angle = $angle;
		$this->padding = $padding;
		$this->color = $color;
	}
	
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
	 * Returns the fontsize registered
	 *
	 * @api
	 *
	 * @return float
	 */
	public function getFontSize(): float {
		return $this->fontSize;
	}
	
	/**
	 * Returns the padding for the text, if $this->padding is null, it'll create a new Vector2 at position 0;0
	 *
	 * @api
	 *
	 * @return Vector2
	 */
	public function getPadding(): Vector2 {
		return $this->padding ?? new Vector2(0, 0);
	}
	
	/**
	 * Returns the path to the font file
	 *
	 * @api
	 *
	 * @return string
	 */
	public function getFontPath(): string {
		return $this->fontPath;
	}
	
	/**
	 * Returns the angle you wanted to have
	 *
	 * @api
	 *
	 * @return float
	 */
	public function getAngle(): float {
		return $this->angle;
	}
	
	public function getColor(): RGB {
		return $this->color ?? new RGB(0, 0, 0);
	}
}