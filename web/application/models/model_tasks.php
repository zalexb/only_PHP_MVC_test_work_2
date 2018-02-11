<?
class Model_Tasks extends Model{
    public function get($per_page,$path,$sort_by = null){

        if(!empty($sort_by)) {
            $sort_by = Lib::clearRequest($sort_by);
            $sort_by = 'ORDER BY ' . $sort_by;
        }

        $total_items = $this->db->makeQuery('SELECT COUNT(*) from `tasks`');

        $total_items = (int)$total_items[0]['COUNT(*)'];

        $query ="SELECT * FROM `tasks` GROUP BY id DESC ".$sort_by;

        $data = Paginator::paginate($this->db,$query,$per_page,$total_items,$path);

        return $data;

    }

    public function status_change(){
        $id = Lib::clearRequest($_POST['id']);
        $status = $_POST['status'];

        $query ="UPDATE `tasks` SET `status`=".$status." WHERE id =".$id;

        $this->db->makeQuery($query);

        return true;
    }
    public function content_change(){
        $id = Lib::clearRequest($_POST['id']);
        $content = Lib::clearRequest($_POST['content']);

        if (empty($content)) {
            return ['error'=>'Введите текст задачи'];
        }
        $query ="UPDATE `tasks` SET `content`='".$content."' WHERE id =".$id;

        $this->db->makeQuery($query);

        return ['content'=>$content];
    }


    public function create(){
        $name = Lib::clearRequest($_POST['name']);
        $email = Lib::clearRequest($_POST['email']);
        $content = Lib::clearRequest($_POST['content']);

        if(!preg_match("/^[\p{L}]+$/u",$name)){
            $_SESSION['errors'] = 'Не коректно введено имя';
            header("location: /");
            die();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['errors'] = 'Не коректно введен email';
            header("location: /");
            die();
        }

        if (!hash_equals($_SESSION['token'], $_POST['token'])) {
            $_SESSION['errors'] = 'Токен не совпадает';
            header("location: /");
            die();
        }
        if (empty($content)) {
            $_SESSION['errors'] = 'Введите текст задачи';
            header("location: /");
            die();
        }


        if(empty($_FILES['img']['name'])){
            $upl_img = [];
            $upl_img[0] = null;
        }
        else {
            $upl_img = Lib::upload_image("img");


            if (!$upl_img) {
                header("location: /");
                die();
            }

            list($w_i, $h_i) = getimagesize('uploaded/' . $upl_img[0]);

            if ($w_i > 320)
                Lib::resize('uploaded/' . $upl_img[0], 'uploaded/' . $upl_img[0], '320');
            if  ($h_i > 240&&($w_i/$h_i<=1.4))
                Lib::resize('uploaded/' . $upl_img[0], 'uploaded/' . $upl_img[0], false,'240');

        }


        $query = 'INSERT INTO `tasks`( `name`, `content`, `email`, `img`,`created_at`) VALUES ("'.$name.'","'.$content.'","'.$email.'","'.$upl_img[0].'",CURRENT_TIMESTAMP())';

        $this->db->makeQuery($query);

        return true;
    }

}