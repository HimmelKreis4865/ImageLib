<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use position\Vector2;
use function array_filter;

class LineGraph extends BaseShape {
	
	/** @var Vector2[] $points */
	private array $points = [];
	
	/**
	 * LineGraph constructor.
	 *
	 * @param Vector2|null $padding
	 * @param Color|null $color
	 * @param int $size
	 * @param Vector2[] $points
	 */
	public function __construct(?Vector2 $padding = null, ?Color $color = null, private int $size = 1, array $points = []) {
		parent::__construct($padding, $color);
		$this->points = array_filter($points, function($key) {
			return ($key instanceof Vector2);
		});
	}
	
	public function draw(GdImage $image): void {
		$lastPos = new Vector2(0, 0);
		foreach ($this->points as $point) {
			$line = new Line($lastPos, $point, $this->size, $this->getColor());
			$line->draw($image);
		}
	}
}