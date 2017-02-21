<?php
/**
 * Created by IntelliJ IDEA.
 * User: Егор
 * Date: 18.02.2017
 * Time: 22:02
 */
require_once 'DB.php';

class DBImpl implements DB
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = '';
    private $db_name = 'contact_manager';
    private $db;

    public function connect()

    {
        //TODO: Implement connect() method.
        $this->db = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name) OR DIE("Не могу создать соединение ");
    }

    public function query($contact)
    {
        // TODO: Implement query() method.
        $sql = mysqli_query($this->db, "INSERT INTO contacts (name, number, date) VALUES ('$contact->name','$contact->number','$contact->date')");
        if ($sql) {
            setcookie('s', 1);
            header("location: /");
            echo "Информация занесена в базу данных";
        } else {
            echo "Информация не занесена в базу данных";
        }
    }
    public function getContact($id_contact){
        $query = mysqli_query($this->db, "SELECT * FROM contacts  WHERE id=$id_contact");

//        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
//        return $row;
    }
    public function updateContact(){
        $name = $this->contact["name"];
        $number = $this->contact["number"];
        $date = $this->contact["date"];
        $this->id_contact = $_GET['id'];

        $str = "UPDATE contacts SET `name`='$this->name', `number`='$this->number', `date`='$this->date' WHERE `id`='$this->id_contact'";
        $sql = mysqli_query($this->db, $str);
        var_dump($str);
    }

    public function close()
    {
        // TODO: Implement close() method.
        mysqli_close($this->db);
    }
}
