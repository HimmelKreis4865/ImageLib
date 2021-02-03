<?php

namespace image\color\components;

use function imagecolorallocate;

class RGB implements ColorComponent {
	
	/** @var int minimal value for a RGB tag */
    public const MIN_VAL = 0;
    
    /** @var int max value for a RGB tag */
    public const MAX_VAL = 255;
    
    
    /** @var int $red */
    private $red;
    
    /** @var int $green */
    private $green;
    
    /** @var int $blue */
    private $blue;

    /**
     * RGB constructor.
     *
     * @param int|array $red if this argument the others will be constructs after this scheme too
     * @param int $green
     * @param int $blue
     */
    public function __construct($red, int $green = 0, int $blue = 0) {
        if (is_array($red)) {
            $rgb = self::fromArray($red);
            if ($rgb === null) throw new \InvalidArgumentException("Could not parse rgb due to invalid input array!");
            $this->parseRGB($rgb);
            return;
        }
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }


    /**
	 * Returns the red portion of the color
	 *
	 * @api
	 *
     * @return int
     */
    public function getRed(): int {
        return $this->red;
    }
	
	/**
	 * Returns the green portion of the color
	 *
	 * @api
	 *
	 * @return int
	 */
    public function getGreen(): int {
        return $this->green;
    }
	
	/**
	 * Returns the blue portion of the color
	 *
	 * @api
	 *
	 * @return int
	 */
    public function getBlue(): int {
        return $this->blue;
    }
	
	/**
	 * Converts itself into an Array
	 *
	 * @api
	 *
	 * @return int[]
	 */
    public function toArray(): array {
        return [$this->getRed(), $this->getGreen(), $this->getBlue()];
    }
	
	/**
	 * Parses another RGB class to itself and assigns colors (also overwriting old colors!)
	 *
	 * @api
	 *
	 * @param RGB $rgb
	 */
    public function parseRGB(RGB $rgb) {
        $this->red = $rgb->red;
        $this->blue = $rgb->blue;
        $this->green = $rgb->green;
    }
	
	/**
	 * Tries to create a RGB instance from a simple array
	 *
	 * @api
	 *
	 * @param array $array
	 *
	 * @return RGB|null
	 */
    public static function fromArray(array $array): ?RGB {
        $array = array_filter($array, function ($key) {
            return (is_numeric($key) and (intval($key) >= self::MIN_VAL) and (intval($key) <= self::MAX_VAL));
        });
        if (count($array) < 3) return null;
        return new RGB(array_shift($array), array_shift($array), array_shift($array));
    }
	
	/**
	 * Converts itself to an image int (mostly a hex value as int such as 0xFF0000)
	 *
	 * @api
	 *
	 * @param $image
	 *
	 * @return int
	 */
    public function toImageInt($image): int {
    	return imagecolorallocate($image, $this->getRed(), $this->getGreen(), $this->getBlue());
	}
	
	/**
	 * Returns whether any data can be converted to RGB
	 *
	 * @api
	 *
	 * @param mixed $data
	 *
	 * @return bool
	 */
    public static function isValid($data): bool {
        return (is_array($data) and self::fromArray($data) instanceof RGB or $data instanceof RGB);
    }
}