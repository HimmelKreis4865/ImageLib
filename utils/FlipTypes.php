<?php

namespace utils;

use const IMG_FLIP_BOTH;
use const IMG_FLIP_HORIZONTAL;
use const IMG_FLIP_VERTICAL;

interface FlipTypes {
	/**
	 * @api
	 *
	 * Flips the image vertically, similar to a 180 degree rotation
	 */
	public const TYPE_VERTICAL = IMG_FLIP_VERTICAL;
	
	/**
	 * @api
	 *
	 * Flips the image horizontally, like a mirror
	 */
	public const TYPE_HORIZONTAL = IMG_FLIP_HORIZONTAL;
	
	/**
	 * @api
	 *
	 * Flips the image
	 * horizontally @see FlipTypes::TYPE_HORIZONTAL and
	 * vertically @see FlipTypes::TYPE_VERTICAL
	 */
	public const TYPE_BOTH = IMG_FLIP_BOTH;
}