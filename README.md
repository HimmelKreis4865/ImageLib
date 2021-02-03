# ImageLib
This PHP Library is designed to be as easy understandable as possible.
A better README will follow soon, this is just a simple documentation of the functions you have!

**WARNING:** Right now you need to create your own autoloader or take a look at the bottom of this page!

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

### More description will follow soon...WIP