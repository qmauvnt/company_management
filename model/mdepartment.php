<?php 

function get_dep(){
    global $db;
    
    try {

        $query = 'SELECT * FROM department';

        $statement = $db->prepare($query);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;
}

function get_name_pos($DId){
    global $db;

    try {

        $query = 'SELECT employee.EId, employee.Name, position.Position, position.Authority,position.Id
        FROM employee, position, workfor 
        WHERE (workfor.DId=:did) AND (workfor.EId=Employee.EId) AND (position.Id=workfor.position)
        ORDER BY position.Authority DESC ';

        $statement = $db->prepare($query);
        $statement->bindValue(':did', $DId);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;

}

function get_dep_auth($EId){

global $db;

    try {
        $query = 'SELECT DId, Authority 
        FROM employee, workfor, position
        WHERE (workfor.EId=Employee.EId) AND (position.Id=workfor.position) AND (employee.EId=:Eid)';

        $statement = $db->prepare($query);
        $statement->bindValue(':Eid', $EId);
        $statement->execute();

        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;
}

function get_pos(){

global $db;

    try {
        $query = 'SELECT * FROM position';

        $statement = $db->prepare($query);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;
}

function get_not_in_dep(){

global $db;

    try {
        $query = 'SELECT EId FROM employee WHERE EId NOT IN (SELECT EId FROM workfor)';

        $statement = $db->prepare($query);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;
}

function change_position($EId,$DId,$Pos){
    global $db;

    try {

        $query = 'UPDATE workfor
                  SET Position=:pos
                    WHERE EId=:user AND DId=:did' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':pos', $Pos);
        $statement->bindValue(':did', $DId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
    

}

function add_employee_dep($EId,$DId){
    global $db;

    try {

        $query = 'INSERT INTO workfor VALUES (:user,:did,3)' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':did', $DId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

}

function delete_emp_dep($EId,$DId){
    global $db;

    try {

        $query = 'DELETE FROM workfor
                    WHERE EId=:user AND DId=:did' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':did', $DId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

}

function add_department($Name,$Info){
    global $db;

    try {

        $query = 'INSERT INTO department(Name,Info,LimitAuth) VALUES (:name,:info,2)' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':name', $Name);
        $statement->bindValue(':info', $Info);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

}


function delete_department($DId){
    global $db;

    try {

        $query = 'DELETE FROM department
                    WHERE DId=:did' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':did', $DId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
    }
    if ($count==0) {
        echo "<script type='text/javascript'>alert('Bạn phải xóa các nhân viên và dự án liên quan trước.');</script>";
        # code...
    } else {
        echo "<script type='text/javascript'>alert('Xóa thành công.');</script>";
    }
}


?>