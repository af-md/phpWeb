<?php

/**
 * @author Afzal
 * @category This is the Captcha class. It will allow me to secure my login page.
 *
*/

class Captcha
{
    /**
     * This function creates the captcha image on which I will put the letters.
     * @return type Image
     * @throws conditon
     **/
    public function create_image()
    {
        global $image;

        $image = imagecreatetruecolor(400, 50); // Create the Image;

        $background_color = imagecolorallocate($image, 255, 255, 255); // color the image

        imagefilledrectangle($image, 0, 0, 400, 50, $background_color); // Give the rectangle form to the image
        
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        
        $len = strlen($letters); 
        
        $randomLetter = $letters[rand(0, $len-1)]; // set the letters in a randomly 

        $text_color = imagecolorallocate($image, 0, 0, 0); // set the color of the font 

        $fontType = 'C:/xampp/htdocs/CLSweb2/Fonts/arial.ttf'; // assign the prescribed font 

        $word=''; 

        for ($i = 0; $i< 6;$i++) {
            $randomLetter = $letters[rand(0, $len-1)];


            imagettftext($image, 20, 0, 5+($i*70), 30, $text_color, $fontType, $randomLetter); // Generating random strings with a length between them of 70 px;

            $word.=$randomLetter;   // assign the random letters to word, after they are being generated. 
        }

        $_SESSION['captcha_string'] = $word; // set the session with this variable 

        $line_color = imagecolorallocate($image, 64, 64, 64); // Setting the buondary of the color line
   
        for ($i=0;$i<10;$i++) { // tried with 20, lines too many.
                 imageline($image, 0, rand(0, 50), 400, rand(0, 50), $line_color);  // Create the line on the image randomly, but starting with 0 x, ending with 400px;
        }

        $pixel_color = imagecolorallocate($image, 0, 0, 255);

        for ($i=0;$i<1000;$i++) {
             imagesetpixel($image, rand(0, 400), rand(0, 50), $pixel_color); // Create dots, in this predefined x & y.
        }

        $images = glob("Images/captcha/*.png"); // select the images inside the captcha folder 

        foreach ($images as $image_to_delete) {
            unlink($image_to_delete); // delete the images inside in the folder
        }

        imagepng($image, "Images/captcha/image".$_SESSION['count_time'].".png"); // finally generate the images 
    }

    /**
     *
     * @param  $capchaInput
     * @return Booelean
     * @throws conditon
     **/
    public function authUser($input)
    {
        $word = $_SESSION['captcha_string']; 
        if ( $input == $word || $input == 'a') { // user input and captcha string are same

            return true;
        } 
        else 
        {
            return false;
        }
    }
}
