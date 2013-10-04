<?php

/**
 * Image Helper Class
 * Some functions depends on the image component (kohana image manipulation)
 *
 * @author     AB
 * @version 20111201
 *
 */
class ImageHelper{

    /**
     * Function used when doing custom crop with jquery
     * Needs image component (kohana image manipulation)
     */
    public static function customCrop($image, $x1, $y1, $w, $h, $croppingWidth, $width, $height){
        $realWidth = $image->width;
        $realHeight = $image->height;
        $croppingHeight = round($croppingWidth * $realHeight / $realWidth);
        $rw = $realWidth / $croppingWidth;
        $rh = $realHeight / $croppingHeight;
        $w = $rw * $w;
        $x1 = $rw * $x1;
        $h = $rh * $h;
        $y1 = $rh * $y1;
        $image->crop($w, $h, $y1, $x1);
        $image->resize($width, $height, Image::NONE);
        return $image;
    }

    /**
     * Smart Crop function, best resize first then crop
     * Needs image component (kohana image manipulation)
     */
    public static function smartCrop($image, $width, $height){
        $realWidth = $image->width;
        $realHeight = $image->height;
        $realR = $realWidth / $realHeight;
        $r = $width / $height;
        if($realR < $r)
            $image->resize($width, $height, Image::WIDTH);
        else
            $image->resize($width, $height, Image::HEIGHT);
        $image->crop($width, $height);
        return $image;
    }

    /**
     * Resize PNG image to JPG with full quality
     * @param string $image1Path  Source path
     * @param string $image2Path  Destination Path
     * @param integer $resizeWidth  Destination Width
     * @param integer $resizeHeight  Destination Height
     */
    public static function resizeFullQuality($image1Path, $image2Path, $resizeWidth, $resizeHeight){
        list( $width, $height ) = getimagesize($image1Path);
        $image1 = ImageHelper::openImage($image1Path);
        $copied = false;
        if($image1){
            $image2 = imagecreatetruecolor($resizeWidth, $resizeHeight);
            imagecopyresized($image2, $image1, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $width, $height);
            $copied = imagejpeg($image2, $image2Path, 100);
            imagedestroy($image1);
            imagedestroy($image2);
        }
        return $copied;
    }

    /**
     * Changes Image DPI to 300*300
     * @param string $path  Image path 
     */
    public static function changeDPI($path){
        $image = file_get_contents($path);
        $image = substr_replace($image, pack("cnn", 1, 300, 300), 13, 5);
        file_put_contents($path, $image);
    }

    /**
     * Opens Image according to its extension
     * @param string $file  Image path
     * @return mixed  Returns image or false if file not image.
     */
    public static function openImage($file){
        $extension = strtolower(strrchr($file, '.'));
        switch($extension){
            case '.jpg':
            case '.jpeg':
                $img = imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = imagecreatefromgif($file);
                break;
            case '.png':
                $img = imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

}

