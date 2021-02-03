<?php

namespace image;

use image\color\Color;
use image\font\BaseFont;
use image\font\ExtendedFont;
use image\font\Font;
use image\shapes\BaseShape;
use InvalidArgumentException;
use OutOfRangeException;
use position\Vector2;
use utils\FlipTypes;
use utils\SquareConverter;
use function file_exists;
use function getimagesize;
use function header;
use function imagecolorallocate;
use function imagecolortransparent;
use function imagecopymerge;
use function imagecopyresampled;
use function imagecreatefromjpeg;
use function imagecreatefrompng;
use function imagecreatetruecolor;
use function imagedestroy;
use function imagefill;
use function imagefilledellipse;
use function imageflip;
use function imagejpeg;
use function imageline;
use function imagepng;
use function imagerotate;
use function imagestring;
use function imagesx;
use function imagesy;
use function imagettftext;
use function in_array;
use function is_dir;
use function is_resource;
use function is_string;

final class Image {
	
	/** @var string[] an array with all currently supported extensions */
	public const SUPPORTED_EXTENSIONS = ["png", "jpg", "jpeg"];
	
	/** @var resource $image */
	public $image;
	
	/**
	 * @var int $width manual width,
	 * will be removed in future and replaced with @see imagesx
	 */
	protected $width;
	
	/**
	 * @var int $height manual height,
	 * will be removed in future and replaced with @see imagesy()
	 */
	protected $height;
	
	/**
	 * Image constructor.
	 *
	 * @param resource $image has a type of resource,
	 * to create an image @see Image::make()
	 * or import it from a file @see Image::fromFile()
	 *
	 * @param int $width width for the image, will be removed in future
	 * @param int $height height of the image, will be removed in future
	 */
	public function __construct($image, int $width = 500, int $height = 500) {
		if (!is_resource($image)) throw new InvalidArgumentException("Given image is not a valid resource!");
		$this->image = $image;
		$this->width = $width;
		$this->height = $height;
	}
	
	/**
	 * Tries to create an image from a path (already existing file)
	 *
	 * @api
	 *
	 * @param string $path
	 *
	 * @return static
	 */
	public static function fromFile(string $path): self {
		if (!file_exists($path)) throw new InvalidArgumentException("Path $path does not contain a valid File!");
		
		if (!in_array(($ext = Utils::getFileExtension($path)), self::SUPPORTED_EXTENSIONS)) throw new InvalidArgumentException("Extension $ext is invalid");
		
		list ($width, $height) = getimagesize($path);
		return new self(self::createImage($path), $width, $height);
	}
	
	/**
	 * Creates an image with given width and height
	 *
	 * @api
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return static
	 */
	public static function make(int $width, int $height): self {
		return new self(imagecreatetruecolor($width, $height), $width, $height);
	}
	
	/**
	 * Directly creates an image from path
	 *
	 * @api
	 *
	 * @param string $path
	 *
	 * @return false|\GdImage|resource|null
	 */
	protected static function createImage(string $path) {
		$ext = Utils::getFileExtension($path);
		
		switch ($ext) {
			case "png":
				return imagecreatefrompng($path);
			
			case "jpeg":
			case "jpg":
				return imagecreatefromjpeg($path);
				
			default:
				return null;
		}
	}
	
	/**
	 * Should draw a trangle
	 *
	 * @api
	 *
	 * @warning Currently not tested
	 *
	 * @deprecated Will be replaced with an object of BaseShape
	 *
	 * @param int $size
	 * @param Vector2 $position
	 * @param Color $color Can be a gradient
	 */
	public function drawTriangle(int $size, Vector2 $position, Color $color) {
		for ($i = $position->getY(); $i < ($size + $position->getY()); $i++) {
			imageline($this->image, $i, $i, ($size + $position->getX()), $i, $color->getColor($this->image, $i, $size));
		}
	}
	
	/**
	 * Fills an image with given color
	 *
	 * @api
	 *
	 * @param Color $color Can be a gradient
	 */
	public function fill(Color $color) {
		if ($color->isSingleColored()) {
			imagefill($this->image, 0, 0, $color->getColor($this->image, 0, 0));
			return;
		}
		for ($i = 0; $i < $this->height; $i++) {
			imageline($this->image, 0, $i, $this->height, $i, $color->getColor($this->image, $i, $this->height));
		}
	}
	
	/**
	 * Returns the rotated image or directly changes it in image if $change is true
	 *
	 * @api
	 *
	 * @param int $degrees
	 * @param bool $change if true, the image will automatically change its rotation too
	 *
	 * @return false|\GdImage|resource
	 */
	public function rotate(int $degrees, bool $change = true) {
		if ($degrees < 0 or $degrees > 360) throw new OutOfRangeException("You can only rotate between 0-360 degrees! $degrees is out of range!");
		$image = imagerotate($this->image, floatval($degrees), 0);
		if ($change) $this->image = $image;
		return $image;
	}
	
	/**
	 * Draws a shape on the image, mostly having a padding, color and some other properties
	 *
	 * @api
	 *
	 * @param BaseShape $baseShape
	 */
	public function drawShape(BaseShape $baseShape) {
		$baseShape->draw($this->image);
	}
	
	/**
	 * Displays the whole image as png in browser
	 *
	 * @api
	 */
	public function display() {
		header('Content-Type: image/png');
		imagepng($this->image);
		imagedestroy($this->image);
	}
	
	/**
	 * Stores the image to a file to keep it save
	 *
	 * @api
	 *
	 * @param string $path
	 */
	public function save(string $path) {
		if (file_exists($path) or is_dir($path)) throw new InvalidArgumentException("Cannot overwrite an existing element for save progress!");
		
		switch (Utils::getFileExtension($path)) {
			case "png":
				imagepng($this->image, $path);
				break;
			case "jpg":
			case "jpeg":
				imagejpeg($this->image, $path);
				break;
		}
	}
	
	/**
	 * Sets a base text to the image, if you want to use custom texts, @see Image::addExtendedText()
	 *
	 * @api
	 *
	 * @param string|Font $text
	 */
	public function addBaseText($text) {
		if (is_string($text)) $text = new BaseFont($text);
		if (!$text instanceof Font) throw new InvalidArgumentException("You can either pass a Font instance or a string to add!");
		imagestring($this->image, $text->getFontSize(), $text->getPadding()->getX(), $text->getPadding()->getY(), $text->getText(), $text->getColor()->toImageInt($this->image));
	}
	
	/**
	 * Adds a customizable Text to the image including custom fonts, angles, padding, color, size and much more
	 *
	 * @api
	 *
	 * @param ExtendedFont $font
	 */
	public function addExtendedText(ExtendedFont $font) {
		imagettftext($this->image, $font->getFontSize(), $font->getAngle(), $font->getPadding()->getX(), $font->getPadding()->getY(), $font->getColor()->toImageInt($this->image), $font->getFontPath(), $font->getText());
	}
	
	/**
	 * This image adds another image to this image, will cover everything under it unless you decrease opacity
	 *
	 * @api
	 *
	 * @param Image $image
	 * @param Vector2 $padding
	 * @param bool $rounded if true, the image will be round like a circle, false will display the original image
	 * For a great experience and nice looking pictures, use @see Image::toSquare() before
	 * @param int $opacity
	 */
	public function addImage(Image $image, Vector2 $padding, bool $rounded = false, int $opacity = 100) {
		$image = $image->image;
		$width = imagesx($image);
		$height = imagesy($image);
		
		if ($rounded) {
			
			$mask = imagecreatetruecolor($width, $height);
			$maskTransparent = imagecolorallocate($mask, 255, 0, 255);
			imagecolortransparent($mask, $maskTransparent);
			imagefilledellipse($mask, $width / 2, $height / 2, $width, $height, $maskTransparent);
			
			imagecopymerge($image, $mask, 0, 0, 0, 0, $width, $height, 100);
			
			$dstTransparent = imagecolorallocate($image, 255, 0, 255);
			imagefill($image, 0, 0, $dstTransparent);
			imagefill($image, $height - 1, 0, $dstTransparent);
			imagefill($image, 0, $height - 1, $dstTransparent);
			imagefill($image, $width - 1, $width - 1, $dstTransparent);
			imagecolortransparent($image, $dstTransparent);
		}
		
		imagecopymerge($this->image, $image, $padding->getX(), $padding->getY(), 0, 0, $width, $height, $opacity);
	}
	
	/**
	 * Resizes an image to given width and height, may become ugly so try to use @link Image::toSquare() before
	 *
	 * @api
	 *
	 * @param int $width
	 * @param int $height
	 */
	public function resizeTo(int $width, int $height) {
		$new = imagecreatetruecolor($width, $height);
		imagecopyresampled($new, $this->image, 0, 0, 0, 0, $width, $height, imagesx($this->image), imagesy($this->image));
		$this->image = $new;
		$this->width = $width;
		$this->height = $height;
	}
	
	/**
	 * Converts an image to a squared image, either center, left or right aligned
	 *
	 * @api
	 *
	 * @param int $type
	 */
	public function toSquare(int $type = SquareConverter::TYPE_CENTER) {
		switch ($type) {
			case SquareConverter::TYPE_CENTER:
				$this->image = SquareConverter::converterToCenter($this->image);
				break;
			case SquareConverter::TYPE_LEFT:
				$this->image = SquareConverter::converterToLeft($this->image);
				break;
			case SquareConverter::TYPE_RIGHT:
				$this->image = SquareConverter::converterToRight($this->image);
				break;
		}
	}
	
	/**
	 * Flips an image in a given mode
	 *
	 * @api
	 *
	 * @param int $flipMode for valid modes,
	 * checkout @see FlipTypes
	 */
	public function flip(int $flipMode) {
		if (in_array($flipMode, [FlipTypes::TYPE_HORIZONTAL, FlipTypes::TYPE_VERTICAL, FlipTypes::TYPE_BOTH]))
			imageflip($this->image, $flipMode);
	}
}