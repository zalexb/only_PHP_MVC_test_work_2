<?
class Lib{
        static  function clearRequest($req){
			return trim(strip_tags(htmlspecialchars($req)));		
		}

        static function mysqli_fetch_all_my($rows){
			$arr=[];

			while ($row = mysqli_fetch_assoc($rows)) {
				$arr[] = $row;
			}

			return $arr;
		}

		static function mysqli_fetch_all_my_one($rows){
			return mysqli_fetch_assoc($rows);
		}

    static function upload_image($input_name)
    {
        $type = trim(htmlspecialchars(strip_tags($_FILES["$input_name"]["type"])));
        $arrName = explode(".", $_FILES["$input_name"]["name"]);
        $name = $arrName[count($arrName)-1];
        global $url_uploaded_img;
        $url_uploaded_img[] = md5(microtime().uniqid().rand(0,9999)).".".$name;
        $count=count($url_uploaded_img);

        if ($name=="png"&&$type=="image/png"||$name=="jpeg"&&$type=="image/jpeg"||$name=="jpg"&&$type=="image/jpeg"||$name=="gif"&&$type=="image/gif") {
            if ((int)$_FILES["$input_name"]["error"] === 0)
            {
                move_uploaded_file($_FILES["$input_name"]["tmp_name"], "uploaded/".$url_uploaded_img[$count-1]);
                return $url_uploaded_img;
            }
            else
                return false;
        }
        else{
            $_SESSION['errors'] = 'Картинки могут быть только png, jpg, gif';
            return false;
        }

    }

    static function resize($file_input, $file_output, $w_o  = false, $h_o = false)
    {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            $_SESSION['errors'] = 'Невозможно получить длину и ширину изображения';
            return false;
        }
        $types = array('','gif','jpeg','png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom'.$ext;
            $img = $func($file_input);
        }else{
            $_SESSION['errors'] = 'Некорректный формат файла';
            return false;
        }

        if (!$h_o) $h_o = $w_o/($w_i/$h_i);
        if (!$w_o) $w_o = $h_o/($h_i/$w_i);

        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
        if ($type == 2) {
            return imagejpeg($img_o,$file_output,100);
        } else {
            $func = 'image'.$ext;
            return $func($img_o,$file_output);
        }
    }

}
