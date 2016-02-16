<?php 
    $dsn = 'mysql:host=localhost;dbname=company';
    $username = 'root';
    $password = '321654987';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
    
    $db->exec("set names utf8");

function get_full($user){
    global $db;
    
    try {

        $query = 'SELECT * FROM employee
                  WHERE EId = :user';

        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->execute();

        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            
    }

    return $name;
}

function add_month($EId,$description,$Money){
	global $db;

    try {
    	$time = date('Y:m:d', time());
        $query = 'INSERT INTO month(EId, Mid, Descript, Money ) VALUES ("'.$EId['EId'].'","'.$time.'","'.$description.'","'.$Money.'")';

        $db->exec($query);
        
    } catch (Exception $e) {
            return false;
    }
    return true;
}





if(isset($_POST['submit'])) {
	$EId = get_full($_POST['EId']);
	$description = array();
	$description[0] = $_POST['luongcoban'];
	$description[1] = $_POST['phucap'];
	$luongduan = implode('', $_POST['luongduan']);
	$description[2] = $luongduan;
	$import_description = implode('<br>', $description);
	$sum = $_POST['sum'];
	$add_month = add_month($EId,$import_description,$sum);

}

?>