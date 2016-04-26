<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Text;

/**
 * Upload component
 */
class UploadComponent extends Component
{

    public $max_files = 3;


    public function send( $data, $options)
    {
    	if ( !empty( $data ) ) {
    		if ( count( $data ) > $this->max_files ) {
    			throw new InternalErrorException("Error Processing Request. Max number files accepted is {$this->max_files}", 1);
    		}
    		
    		$return = []; //array que devuelve los nombres de los archivos subidos.
    		
    		foreach ($data as $file) {
    			$filename = $file['name'];
    			$file_tmp_name = $file['tmp_name'];
    			$dir = WWW_ROOT.'uploads'.DS.$options['dir'];
    			$allowed = $options['allowed'];
    			if ( !in_array( substr( strrchr( $filename , '.') , 1 ) , $allowed) ) {
    				throw new InternalErrorException("Error Processing Request.", 1);
    			}elseif( is_uploaded_file( $file_tmp_name ) ){
    			    $final_name = Text::uuid().'-'.$filename;
    			    move_uploaded_file($file_tmp_name, $dir.DS.$final_name);
    				
    				if ($options['redim']){ //Si está a true la opción de redimensionar, ejecutamos la siguiente acción.
    				    $this->create_scaled_image($dir.DS.$final_name, $options['width'], $options['height']);
    				}
    				
    				array_push($return, $final_name);
    			}
    		}
    		
    		return $return;
    	}
    }
    
    protected function create_scaled_image($file_name, $width, $height) {
        
        $file_path = $file_name;
        $new_file_path = $file_name;
        
        list($img_width, $img_height) = @getimagesize($file_path);
        
        if (!$img_width || !$img_height) {
            return false;
        }
        $scale = min(
            $width / $img_width,
            $height / $img_height
        );
        if ($scale >= 1) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        $new_width = $img_width * $scale;
        $new_height = $img_height * $scale;
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                $image_quality = 75;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                $image_quality = 9;
                break;
            default:
                $src_img = null;
        }
        $success = $src_img && @imagecopyresampled(
            $new_img,
            $src_img,
            0, 0, 0, 0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
        ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }
    
}