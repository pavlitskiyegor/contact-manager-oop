<?php
error_reporting(E_ALL);
ini_set('display_errors', true); //показывает ошибки
require_once 'DBImpl.php';
class Contact{
    public $id;
    public $name;
    public $number;
    public $date;
}
class ChangeContactApp{
    public $id_contact;

    public static function main(){
        $app = new ChangeContactApp();
        $app->isId();
        $app->updateContact();
    }
    public function isId(){
        var_dump($_GET['id']);
        if (!isset($_GET['id'])) {
            echo "no id";
            exit();
        }
    }
    public function updateContact(){
        $db= new DBImpl();
        $db->connect();
        $db->getContact($this->id_contact);
        if (isset($_POST['submit'])) {
            $db->updateContact();
            if ($db->updateContact()){
                header('Location:/index.php');
            }else {
                echo "not update! ";
            }
        }
        $db->close();
    }

}
ChangeContactApp::main();
$app= new ChangeContactApp();
$id_contact = $_GET['id'];



//var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/libs/normolize.css">
    <link rel="stylesheet" href="css/libs/bootstrap.css">
    <link rel="stylesheet" href="css/build/style.css" type="text/css">
</head>
<body>
<div class="container ">
    <div class="row ">
        <a href="index.php">
            <div class="col-xs-12 header ">Изменить контакт</div>
        </a>
        <div class="col-xs-12 add-form">
            <form method="post" action="change.php?id=<?php echo $_GET["id"];?>" class="form-horizontal">
                <div class="form-group">
                    <label class="col-xs-3 control-label">Имя</label>
                    <div class="col-xs-8">
                        <input name="name" type="text" class="form-control" placeholder="Имя"
                               value="<?php echo $contact['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Номер телефона</label>
                    <div class="col-xs-8">
                        <input name="number" type="text" class="form-control" placeholder="Номер телефона"
                               value="<?php echo $contact['number']; ?>">
                    </div>
                </div>
                <div class="col-xs-12 add">
                    <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

}
