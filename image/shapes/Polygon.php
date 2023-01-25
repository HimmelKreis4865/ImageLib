<?php

namespace image\shapes;

use GdImage;
use image\color\Color;
use position\Vector2;
use function array_filter;
use function array_map;
use function count;
use function imagefilledpolygon;

class Polygon extends BaseShape {
	
	/**
	 * @param Vector2[] $positions
	 * @param bool $filled
	 * @param Color|null $color
	 */
	public function __construct(private array $positions = [], private bool $filled = false, ?Color $color = null) {
		parent::__construct(null, $color);
	}
	
	/**
	 * @return Vector2[]
	 */
	public function getPositions(): array {
		return $this->positions;
	}
	
	public function draw(GdImage $image): void {
		$finalPositions = [];
		$positions = array_map(function($vector2) {
			return [$vector2->getX(), $vector2->getY()];
		}, array_filter($this->positions, function ($vector2) {
			return ($vector2 instanceof Vector2);
		}));
		
		foreach ($positions as $position) {
			$finalPositions[] = $position[0];
			$finalPositions[] = $position[1];
		}
		
		if ($this->filled) {
			imagefilledpolygon($image, $finalPositions, (count($positions)), $this->getColor()->getColor($image, 0, 0));
		} else {
			imagepolygon($image, $finalPositions, (count($positions)), $this->getColor()->getColor($image, 0, 0));
		}
	}
}