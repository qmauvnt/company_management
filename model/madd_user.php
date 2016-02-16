<?php 

function get_next_eid()
{

	global $db;
    
    try {

        $query = 'SELECT MAX(EId)+1 as max FROM employee';

        $statement = $db->prepare($query);
        $statement->execute();

        $name=$statement->fetch()['max'];

        $statement->closeCursor();
        
    } catch (Exception $e) {
            
    }

    return $name;
}

function add_user($EId,$DoB,$Name,$Sex,$Email,$Distance,$BSSalary,$PoF,$pwd){

	global $db;

    try {

        $query = "INSERT INTO employee (EId, DoB,Name,Sex,Email,Distance,BSSalary,PoF,pwd) VALUES (:user,:dob,:name,:sex,:email,:dis,:bssa,:pof,:pwd)" ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':dob', $DoB);
        $statement->bindValue(':name', $Name);
        $statement->bindValue(':sex', $Sex);

        $statement->bindValue(':email', $Email);
        $statement->bindValue(':dis', $Distance);
        $statement->bindValue(':bssa', $BSSalary);
        $statement->bindValue(':pof', $PoF);
        $statement->bindValue(':pwd', $pwd);

        $count=$statement->execute();

    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
    if ($count==0) {
        echo "<script type='text/javascript'>alert('Thêm nhân viên thất bại');</script>";
    }else{
        echo "<script type='text/javascript'>alert('Thêm nhân viên thành công');</script>";
    }
}

?>