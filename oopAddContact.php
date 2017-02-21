<?php
/**
 * Created by IntelliJ IDEA.
 * User: Егор
 * Date: 01.02.2017
 * Time: 2:08
 */
error_reporting("E_ALL");
ini_set('display_errors', true); //показывает ошибки

require_once 'DBImpl.php';

class Contact
{
    public $id;
    public $name;
    public $number;
    public $date;

}





class AddContactApp
{
    public $contact;
    public $errors=[];
    public static function main()
    {
        $app = new AddContactApp();
        if (isset($_POST['submit'])) {
            $data = [
                "name" => trim($_POST['name']),
                "number" => trim($_POST['number']),
                "date" => date('y/m/d h:i:s')
            ];
            $app->createContact($data);
            $app->validateContact();
            $app->addContact();
        }else{
            $app->emptyContact();
        }

//        $contactManager = new DBImpl();
//        //$contact = $contactManager->getEmptyContact();
//        $errors = [];
//        if (isset($_POST['submit'])) {
//            $contact = [
//                "name" => trim($_POST['name']),
//                "number" => trim($_POST['number']),
//                "date" => date('y/m/d h:i:s')
//            ];
//            var_dump($contact);
//
//
//
//            if (count($errors) == 0) {
//                $contactManager ->connect($contact);
//                $contactManager ->query($contact);
//                $contactManager ->close($contact);
//
//                $contact = [
//                    "name" => '',
//                    "number" => ''
//                ];
//            }
//
//        }
//        //$contact->addToList();

    }

    private function createContact($data)
    {
        $this->contact = new Contact();
        $this->contact->name = $data['name'];
        $this->contact->date = $data['date'];
        $this->contact->number = $data['number'];

    }

    private function validateContact()
    {
        if (!isset($this->contact->name) || empty($this->contact->name)) {
            $this->errors["name"] = 'Поле "Имя" не должно быть пустым.';
        }
        if (!isset($this->contact->number) || empty($this->contact->number)) {
            $this->errors["number"] = 'Поле "Номер" не должно быть пустым.';

        }
    }

    private function addContact(){
        $count = count($this->errors);
        if($count== 0){
            $db= new DBImpl();
            $db->connect();
            $db->query($this->contact);
            $db->close();
        }
    }

    private function emptyContact(){
        $this->contact = new Contact();
        $this->contact->name = '';
        $this->contact->date = '';
        $this->contact->number = '';

    }
}

AddContactApp::main();
$app= new AddContactApp();
$errors=$app->errors;
$contact=$app->contact;

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
            <div class="col-xs-12 header ">Добавить контакт</div>
        </a>
        <?php if (isset($_POST['submit']) && count($errors) > 0) { ?>
            <div class="col-xs-12 errors">
                <?php foreach ($errors as $error) { ?>
                    <p><?php echo $error; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="col-xs-12 add-form">
            <form method="post" action="oopAddContact.php" class="form-horizontal">
                <div class="form-group">
                    <label class="col-xs-3 control-label">Имя</label>
                    <div class="col-xs-8">
                        <input name="name" type="text" class="form-control" placeholder="Имя"
                               value="<?php echo $contact->name; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Номер телефона</label>
                    <div class="col-xs-8">
                        <input name="number" type="text" class="form-control" placeholder="Номер телефона" <input
                                name="name" type="text" class="form-control" placeholder="Имя"
                                value="<?php echo $contact->number; ?>">
                    </div>
                </div>
                <div class="col-xs-12 add">
                    <input type="submit" name="submit" class="btn btn-primary" value="Добавить">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>