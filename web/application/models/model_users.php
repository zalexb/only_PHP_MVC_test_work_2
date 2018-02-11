<?
class Model_Users extends Model{

    public function login(){
        $name = Lib::clearRequest($_POST['name']);
        $password = Lib::clearRequest($_POST['password']);

        if(!preg_match("/^[\p{L}1-9]+$/u",$name)){
            return ['error'=>'Не коректно введено имя'];
        }

        if (!hash_equals($_SESSION['token'], $_POST['token'])) {
            return ['error'=>'Токен не совпадает'];
        }

        $query = 'SELECT * FROM `users` WHERE `name` = "'.$name.'"';

        $data = $this->db->makeOnceQuery($query);

        if(!password_verify($password,$data['password'])){
            return ['error'=>'Пароль не совпадает'];
        }

        $_SESSION['login'] = $data['name'];

        return ['name'=>$data['name']];
    }
    public function logout(){
        if(!empty($_SESSION['login']))
            unset($_SESSION['login']);
    }
}