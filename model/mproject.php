<?php 

function get_project(){
    global $db;
    
    try {

        $query = 'SELECT * FROM project';

        $statement = $db->prepare($query);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            
    }

    return $name;
}

function get_name_pospro($PId){
    global $db;

    try {

        $query = 'SELECT employee.EId, employee.Name, position.Position, position.Authority
        FROM employee, position, working 
        WHERE (working.PId=:did) AND (working.EId=Employee.EId) AND (position.Id=working.position)
        ORDER BY position.Id DESC ';
        $statement = $db->prepare($query);
        $statement->bindValue(':did', $PId);
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            
    }

    return $name;

}

function checkEP($EId,$PId){
    global $db;

    try {

        $query = 'SELECT position.Authority
        FROM employee, position, working 
        WHERE (working.PId=:did) AND (working.EId=:eid) AND (position.Id=working.position)';

        $statement = $db->prepare($query);
        $statement->bindValue(':did', $PId);
        $statement->bindValue(':eid', $EId);
        $statement->execute();

        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {

        return 0;
            
    }
    
    if ((count($name)==0) OR (!isset($name['Authority']))) {
        return 0;
    } else {
        return $name['Authority'];
    }
}

function checkEPMoney($EId,$PId){
    global $db;

    try {

        $query = 'SELECT working.SpH
        FROM working 
        WHERE (working.PId=:pid) AND (working.EId=:eid)';

        $statement = $db->prepare($query);
        $statement->bindValue(':pid', $PId);
        $statement->bindValue(':eid', $EId);
        $statement->execute();

        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {

        return 0;
            
    }
    
    return $name;
}


function Delete_EP($PId,$EId){
    global $db;
    try {

        $query = 'DELETE FROM working
                    WHERE EId=:user AND PId=:pid' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':pid', $PId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
  
    if ($count==0) {
        echo "<script type='text/javascript'>alert('Bạn phải xóa các thông tin về lương');</script>";
        # code...
    } else {
        echo "<script type='text/javascript'>alert('Xóa thành công.');</script>";
    }
}

function AddEmpPro($EId,$PId,$Position,$SpH)
{
      global $db;

    try {

        $query = 'INSERT INTO working VALUES (:user,:pid,:position,:SpH)' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $statement->bindValue(':pid', $PId);
        $statement->bindValue(':position', $Position);
        $statement->bindValue(':SpH', $SpH);

        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

}


function get_position($i1,$i2){
    global $db;
    try {
        $query = 'SELECT * FROM position WHERE ((Authority=:i1) OR (Authority=:i2))';

        $statement = $db->prepare($query);
        $statement->bindValue(':i1', $i1);      
        $statement->bindValue(':i2', $i2);      
        $statement->execute();

        $name=$statement->fetchAll();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name;
}

function dep_name($PId){
    global $db;
    try {
        $query = 'SELECT * FROM department WHERE (DId=:pid)';

        $statement = $db->prepare($query);
        $statement->bindValue(':pid', $PId);      
        $statement->execute();

        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    return $name['Name'];   
}

function add_project($DId,$Name,$Info){
       global $db;

    try {

        $query = 'INSERT INTO project(Name,Info,DId) VALUES (:Name,:Info,:DId)' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':Name', $Name);
        $statement->bindValue(':DId', $DId);
        $statement->bindValue(':Info', $Info);

        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
}

function delete_project($PId){
    global $db;
    try {

        $query = 'DELETE FROM project
                    WHERE PId=:pid' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':pid', $PId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
  
    if ($count==0) {
        echo "<script type='text/javascript'>alert('Bạn phải xóa các thông tin liên quan trước.');</script>";
        # code...
    } else {
        echo "<script type='text/javascript'>alert('Xóa thành công.');</script>";
    }

}

?>