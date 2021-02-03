<?php

namespace image;

use function count;
use function explode;
use function strlen;
use function strpos;
use function strrpos;
use function substr;
use const DIRECTORY_SEPARATOR;

class Utils {
	/**
	 * Returns the file extension of a given path, e.g png, jpg, jpeg, gif, php,..
	 * no dot (.) provided
	 *
	 * @internal
	 *
	 * @param string $path
	 * @param string $separator
	 *
	 * @return string
	 */
	public static function getFileExtension(string $path, string $separator = DIRECTORY_SEPARATOR): string {
		$name = self::getFileName($path, $separator);
		if (strpos($name, ".") === false) return $name;
		return (explode(".", $name)[(count(explode(".", $name)) - 1)]);
	}
	
	public static function getFileName(string $path, string $separator = DIRECTORY_SEPARATOR): string {
		if (strpos($path, $separator) === false) return $path;
		return substr($path, (strrpos($path,$separator) + 1), strlen($path));
	}
}