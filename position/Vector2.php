<?php

namespace position;

class Vector2 {
	/** @var int $x */
	public $x;
	
	/** @var int $y */
	public $y;
	
	/**
	 * Vector2 constructor.
	 *
	 * @param int $x the X coordinate of the vector
	 * @param int $y the Y coordinate of the vector
	 */
	public function __construct(int $x, int $y) {
		$this->x = $x;
		$this->y = $y;
	}
	
	/**
	 * Sets the Y coordinate of the vector
	 *
	 * @api
	 *
	 * @param int $x
	 */
	public function setX(int $x): void {
		$this->x = $x;
	}
	
	/**
	 * Sets the Y coordinate of the vector
	 *
	 * @api
	 *
	 * @param int $y
	 */
	public function setY(int $y): void {
		$this->y = $y;
	}
	
	/**
	 * Returns the X coordinate of the vector
	 *
	 * @api
	 *
	 * @return int
	 */
	public function getX(): int {
		return $this->x;
	}
	
	/**
	 * Returns the Y coordinate of the vector
	 *
	 * @api
	 *
	 * @return int
	 */
	public function getY(): int {
		return $this->y;
	}
	
	/**
	 * Returns whether two vectors are equivalent or not
	 *
	 * @api
	 *
	 * @param Vector2 $vector2
	 *
	 * @return bool
	 */
	public function equals(Vector2 $vector2): bool {
		return ($vector2->getX() === $this->getX() and $vector2->getY() === $this->getY());
	}
	
	/**
	 * Returns the position as array ( [x, y] )
	 *
	 * @api
	 *
	 * @return int[]
	 */
	public function toArray(): array {
		return [$this->getX(), $this->getY()];
	}
}