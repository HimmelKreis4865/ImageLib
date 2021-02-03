<?php

namespace image\shapes;

use image\color\Color;
use position\Vector2;
use function array_filter;
use function array_map;
use function count;
use function imagefilledpolygon;

class Polygon extends BaseShape {
	/** @var Vector2[] $positions */
	protected $positions = [];
	
	/** @var bool $filled */
	protected $filled = false;
	
	public function __construct(array $positions = [], bool $filled = false, ?Color $color = null) {
		$this->positions = $positions;
		$this->filled = $filled;
		parent::__construct(null, $color);
	}
	
	/**
	 * @return Vector2[]
	 */
	public function getPositions(): array {
		return $this->positions;
	}
	
	/**
	 * @param $image
	 *
	 * @return mixed|void
	 */
	public function draw(&$image) {
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