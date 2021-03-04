<?php

namespace utils;

use position\Vector2;
use function floor;
use function imagecopyresampled;
use function imagecreatetruecolor;
use function imagesx;
use function imagesy;
use function min;

class SquareConverter {
	
	/** @var int type for choosing centered part of the image */
	public const TYPE_CENTER = 0;
	
	/** @var int type for choosing left part of the image */
	public const TYPE_LEFT = 1;
	
	/** @var int type for choosing right part of the image */
	public const TYPE_RIGHT = 2;
	
	/**
	 * Converts the center of an image
	 *
	 * @internal
	 *
	 * @param $image
	 *
	 * @return false|\GdImage|resource
	 */
	public static function converterToCenter($image) {
		$size = self::getSize($image);
		$img = imagecreatetruecolor($size, $size);
		$padding = new Vector2(floor(((imagesx($image) - $size) / 2)), floor(((imagesy($image) - $size) / 2)));
		imagecopyresampled($img, $image, 0, 0, $padding->getX(), $padding->getY(), $size, $size, $size, $size);
		return $img;
	}
	
	/**
	 * Converts the left side of an image
	 *
	 * @internal
	 *
	 * @param $image
	 *
	 * @return false|\GdImage|resource
	 */
	public static function converterToRight($image) {
		$size = self::getSize($image);
		$img = imagecreatetruecolor($size, $size);
		$padding = new Vector2((imagesx($image) - $size), 0);
		imagecopyresampled($img, $image, 0, 0, $padding->getX(), $padding->getY(), $size, $size, $size, $size);
		return $img;
	}
	/**
	 * Converts the right side of an image
	 *
	 * @internal
	 *
	 * @param $image
	 *
	 * @return false|\GdImage|resource
	 */
	public static function converterToLeft($image) {
		$size = self::getSize($image);
		$img = imagecreatetruecolor($size, $size);
		$padding = new Vector2(0, 0);
		imagecopyresampled($img, $image, 0, 0, $padding->getX(), $padding->getY(), $size, $size, $size, $size);
		return $img;
	}
	
	/**
	 * Returns the size needed for each side of the square, here we'll choose the min value of the sides
	 *
	 * @internal
	 *
	 * @param $image
	 *
	 * @return int
	 */
	private static function getSize($image): int {
		return min(imagesx($image), imagesy($image));
	}
}
