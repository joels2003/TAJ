<?php
// Create an image with specified width and height
$imageWidth = 300;
$imageHeight = 400;
$image = imagecreate($imageWidth, $imageHeight);

// Define colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Define text
$text = "Your Bill Receipt:\n\n";
$text .= "First Name: John\n";
$text .= "Last Name: Doe\n";
$text .= "Contact Number: 123-456-7890\n";
$text .= "Vehicle Name: Sedan\n";
$text .= "Service ID: 12345\n";
$text .= "Pickup Date: 2023-01-01\n";
$text .= "Delivery Date: 2023-01-02\n";
$text .= "Parts:\n";
$text .= "- Part 1: $50\n";
$text .= "- Part 2: $30\n";
$text .= "- Part 3: $20\n";
$text .= "Total Amount: $100\n";

// Add text to the image
imagettftext($image, 12, 0, 10, 30, $black, 'arial.ttf', $text); // You need to specify the font file

// Create a PNG image
header('Content-Type: image/png');
imagepng($image);

// Save the image to a file
imagepng($image, 'bill_receipt.png');

// Clean up
imagedestroy($image);
?>
