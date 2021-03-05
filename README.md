# ImageLib
<a href="https://discord.gg/GCCTxymKct"><img src="https://img.shields.io/discord/808294266886553601?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

This PHP Library is designed to be as easy understandable as possible.
A better README will follow soon, this is just a simple documentation of the functions you have!
This project is mainly designed to interact with <a href="https://github.com/HimmelKreis4865/phpcord">phpcord</a>.

### Installation
You can either download this repository directly from github (you have to create your own autoloader in that case)
or by installing it with [Composer](https://getcomposer.org/).
You simply would execute `composer require himmelkreis4865/imagelib` once you installed it on your device.
_You can also download the phar and run it with php as well_

To enjoy composer's autoload you have to add
```php
require_once __DIR__ . "/vendor/autoload.php";
```
before accessing the first class.

# Explanation
 - `Padding` is the distance between the top left corner and the object. It's telling object's position

## Documentation
### Creating images
You can either create images by getting them from a file:

```php
<?php

use image\Image;

$image = Image::fromFile("file.png");
```

or by creating a new one:

```php
<?php

use image\Image;
// first parameter (300) is the width, second parameter is the height (200)
// both is being measured in pixels
$image = Image::make(300, 200);
```

At the end of your code either add `$image->display();` to display your image or save it with `$image->save("your/path/to/file.png");` (you have to pass your own path and filename)

### Changing the background

```php
use image\color\components\RGB;
use image\color\Gradient;
use image\color\SingleColor;
use image\Image;

$image = Image::make(300, 200);

// fill the background either with a singlecolor (red in this case) or a gradient (red -> yellow in this case)
$image->fill(new SingleColor(new RGB(255)));
// creates a smooth animation between the 2 colors
$image->fill(new Gradient(new RGB(255), new RGB(255, 255)));
```

### Add Text to an image
There are two ways to create a text,

the simple but more ugly way:
```php
<?php

use image\Image;
use image\color\SingleColor;
use image\color\components\RGB;
use image\font\BaseFont;
use position\Vector2;

$image = Image::make(200, 50);

// make the background black
$image->fill(new SingleColor(new RGB(0, 0, 0)));

// add a white default font
$image->addBaseText(new BaseFont("A test string", 4, new Vector2(50, 15), new RGB(255, 255, 255)));

$image->display();
```
This will create an output like

<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/basefont_output.png" alt="basefont_output.png">

The other option you have, is creating an extended font:

```php
<?php

use image\Image;
use image\color\SingleColor;
use image\color\components\RGB;
use position\Vector2;
use image\font\ExtendedFont;

$image = Image::make(200, 50);

// make the background black
$image->fill(new SingleColor(new RGB(0, 0, 0)));

// add a white font of the family "arial" with fontsize 12(px)
$image->addExtendedText(new ExtendedFont("A test string", "arial.ttf", 12, 0.0, new Vector2(50, 30), new RGB(255, 255, 255)));

$image->display();
```
This will create an output like

<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/extended_font_output.png" alt="basefont_output.png">

**Notice:** You can use the fonts `arial.ttf` and `arialbd.ttf` (bold arial) for now, more fonts are coming soon.

### Create Shapes
Shapes are objects such as squares, circles,... that can be added to your image.

Simple do:

```php
// default usage:
$image->drawShape(BaseShape);

// sample:

use image\color\components\RGB;use image\color\SingleColor;use image\shapes\Circle;use position\Vector2;

// This will create a red circle with a padding of 50px in each direction and a size of 100 pixels
$image->drawShape(new Circle(new Vector2(50, 50), new SingleColor(new RGB(255)), 100));
```

Since nearly every shape has a different constructor, you should always take a look at the api before using it.
Current shapes: `image\shapes\Circle`, `image\shapes\Ellipse`, `image\shapes\Line`, `image\shapes\Polygon`, `image\shapes\Rectangle` and `image\shapes\Square`

### Rotation and Flipping
A `image\Image` can be rotated with
```php
$image->rotate($degrees, $change);
```
`$degrees` is an Integer containing the angle (-360 up to 360) 
`$change` is an optional parameter, a boolean that tells the system modify the image directly (`true`) or just return the image (`false`), default is `true`

If you want to flip an Image you can do this by:
```php
use utils\FlipTypes;

$image->flip(FlipTypes::TYPE_HORIZONTAL);
```
Available flip modes: `FlipTypes::TYPE_HORIZONTAL` (like a mirror), `FlipTypes::TYPE_VERTICAL` (like a 180° rotation) and `FlipTypes::TYPE_BOTH` applying both modes

### Square and resize images
"square images" stand for images, that are having the same width as height which is pretty useful regarding resizing and other tools
This can be done by

There are three different square positions, 
`SquareConverter::TYPE_CENTER`, `SquareConverter::TYPE_LEFT`, `SquareConverter::TYPE_RIGHT`

```php
<?php

use image\color\components\RGB;
use image\color\Gradient;
use image\Image;use utils\SquareConverter;

// creating an image with a different width and height
// choosing a greater height than width for a purpose, you'll find out later
$image = Image::make(300, 700);

// adding a gradient to show a difference later
$image->fill(new Gradient(new RGB(255, 255), new RGB(0, 0, 255)));

// now rotating the image because gradients are only applied from top to bottom (we need it vertical)
$image->rotate(90);

// now bringing the center:
$image->toSquare(SquareConverter::TYPE_CENTER);

$image->display();
```

Sample output:

<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/gradient_square_after.png" alt="gradient_square_after.png">

By the way, before squaring it, the image looked like that:
<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/gradient_square_before.png" alt="gradient_square_before.png">

You can make some tests for squaring the left or right side with this code too, but we're not presenting it here.


To resize an image, you can do the following: `$image->resizeTo($new_width, $new_height)`
Sometimes it's a good Idea to square it before resizing.

### Put images into another Image

#### Basic version:
```php
<?php

use image\color\components\RGB;
use image\color\SingleColor;
use image\Image;
use position\Vector2;

// creating the default image:
$image = Image::make(500, 500);
$image->fill(new SingleColor(new RGB(255)));

// creating the target image: (here a sample one you won't find in the code)
$target = Image::fromFile("test.png");

// squaring and resizing it to get the best result
// default parameter is center so I leave it out
$target->toSquare();

$target->resizeTo(400, 400);

// now add the target image to the default one
$image->addImage($target, new Vector2(50, 50));

$image->display();
```

Output:

<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/add_image_basic.png" alt="add_image_basic.png">

#### Extended version:
The difference seems unimportant, but is quite huge:
```php
<?php

use image\color\components\RGB;
use image\color\SingleColor;
use image\Image;
use position\Vector2;

// creating the default image:
$image = Image::make(500, 500);
$image->fill(new SingleColor(new RGB(255)));

// creating the target image: (here a sample one you won't find in the code)
$target = Image::fromFile("test.png");

// squaring and resizing it to get the best result
// default parameter is center so I leave it out
$target->toSquare();

$target->resizeTo(400, 400);

// now add the target image to the default one
$image->addImage($target, new Vector2(50, 50), true, 70);

$image->display();
```

Output:

<img src="https://github.com/HimmelKreis4865/ImageLib/blob/master/docs/img/add_image_extended.png" alt="add_image_extended.png">

This is caused by the 2 additional parameters in `addImage()`:
 - `true` tells the api to make your image round
 - `70` is the opacity for this object (`100` is fully covered, `0` makes it invisible)

### More description is on the way...

## Autoloader
Depending on your OS and folder structure, in a structure like
```
 docs
 image
 position
 utils
 index.php <- Your Entry point
```

You can use this autoloader (**Before the first class usage**)

```php
spl_autoload_register(function(string $class) {
	include str_replace("\u{005C}", DIRECTORY_SEPARATOR, $class) . ".php";
});
```
This should be device independent too

