<?php
$number1 = rand( 1, 5 );
$number2 = rand( 1, 5 );

function random_word( int $length ): string {
    return preg_replace( '/[^A-Za-z0-9]/', '', base64_encode( random_bytes( $length ) ) );
}

$word = random_word( 6 );
$id = random_word( 32 );

file_put_contents( __DIR__ . "/../captchas/captcha_" . $id, $word );

// create image
$image = imagecreatetruecolor( 80, 40 );
$red = imagecolorallocate( $image, 0xFF, 0x00, 0x00 );
$black = imagecolorallocate( $image, 0x00, 0x00, 0x00 );
imagefilledrectangle( $image, 0, 0, 299, 99, $red );
imagefttext( $image, 10, 10, 9, 30, $black, "../Ubuntu-Regular.ttf", $word );

// get image data uri
ob_start();
imagepng( $image );
$image_source = ob_get_contents();
ob_clean();
$image_uri = "data:image/png;base64,".base64_encode( $image_source );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Spammers Please</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <h2>Contact form</h2>
    <form id="form" action="send_form.php" method="post">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="text" name="email" required>

        <label>Message:</label>
        <textarea name="message" required></textarea>

        <label>What does this say?</label>
        <img src="<?php echo $image_uri; ?>" /><br />
        <input type="text" name="check" required>
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
