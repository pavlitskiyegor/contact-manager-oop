<?php
function isId()
{
    var_dump($_GET['delete_id']);
    if (!isset($_GET['delete_id'])) {
        echo "no id";
        exit();
    }
}
function deleteContact($id_contact)
{
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'contact_manager';
    $db_table = 'contacts';
    $id_contact = $_GET['delete_id'];

    $db = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("Не могу создать соединение ");

    $query = mysqli_query($db, "DELETE  FROM contacts  WHERE id=$id_contact");

    if (mysqli_query($db,$query))
    {
        die('Error: ');
    }
    header('Location:/index.php');
    mysqli_close($db);
}
function main(){

    isId();
    global $id_contact;
    $id_contact = $_GET['delete_id'];
    deleteContact($id_contact);

}
main();

