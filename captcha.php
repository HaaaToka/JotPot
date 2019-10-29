<?php

include "functions.php";
session_start();
$captcha = generateRandomString(6);
$_SESSION["captcha"] = $captcha;

// Creates the canvas
// Creates a new image
// image = imagecreate(233, 49);

// Creates the canvas
// Creates an image from a existing image
$image = imagecreatefrompng("./media/img/captcha.png");

// Sets up some colors for use on the canvas
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$orange = imagecolorallocate($image, 222, 77, 14);

// Loads a font (GDF)
// $font = imageloadfont("fonts/atommicclock.gdf");

// Loads a font (TTF)
$font = "./media/fonts/arial.ttf";

// Writes the string (GDF)
// imagestring($image, $font, 0, 0, $captcha, $orange);
// imagestring($image, $font, 40, 10, $captcha, $black);

// Writes the string (TTF)
// imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
imagettftext($image, 20, 0, 75, 38, $orange, $font, $captcha);
        
// Output the image to the browser
header ("Content-type: image/png");
imagepng($image);

// Cleans up after yourself
imagedestroy($image)

?>