<?php 

function get_name($user){
    global $db;
    
    try {

        $query = 'SELECT Name FROM employee
                  WHERE EId = :user';

        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->execute();

        $name=$statement->fetch()['Name'];

        $statement->closeCursor();
        
    } catch (Exception $e) {
            
    }

    return $name;
}

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

function get_img($user){
    global $db;
    return 'img/employee/'.$user.'.jpg';

}


function pos_dep($user){
    global $db;
    
    try {

        $query = 'SELECT position.Position,department.Name 
                    FROM workfor,department,position, employee 
                    WHERE (Employee.EId=:user) AND (department.DId=workfor.DId) AND (position.Id=workfor.`Position`) AND (employee.EId=workfor.EId)' ;

        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $name=$statement->fetch();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
    
    return $name;  
}

function UserChangeInformation($user,$Address,$Phone,$Email){
    global $db;
    
    try {

        $query = 'UPDATE Employee
                    SET Address=:add, Phone=:phone, Email=:email
                    WHERE EId=:user' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $user);
        $statement->bindValue(':phone', $Phone);
        $statement->bindValue(':add', $Address);
        $statement->bindValue(':email', $Email);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
    
    return $count;  
}


function changepass($user,$opwd,$pwd1,$pwd2){
    global $db;

    try {

        $query = 'SELECT pwd FROM employee WHERE EId=:user' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $user);
        $statement->execute();
        $result=$statement->fetch();

        $statement->closeCursor();

        if ($result['pwd']!=sha1($user.$opwd)) {
            echo "<script type='text/javascript'>alert('Hãy nhập đúng password cũ!');</script>";
            return;
        }

        if (($pwd1 != $pwd2) ) {
            echo "<script type='text/javascript'>alert('Hai mật khẩu phải giống nhau!');</script>";
            return;
        }
        if (($pwd1 == '') ) {
            echo "<script type='text/javascript'>alert('Hãy nhập mật khẩu mới!');</script>";
            return;
        }


        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }

    try {

        $query = 'UPDATE Employee
                    SET pwd=:pwd
                    WHERE EId=:user' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':pwd', sha1($user.$pwd1));
        $statement->bindValue(':user', $user);
        $statement->execute();

        $statement->closeCursor();

    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi khi đổi !');</script>";
            return;
    }
        
     echo "<script type='text/javascript'>alert('Đổi mật khẩu thành công!');</script>";

}

function changeimage(){

    if(isset($_POST['ok'])){ // Người dùng đã ấn submit
        
                echo "<script type='text/javascript'>alert('Really annoying pop-up!');</script>";
    if($_FILES['file']['name'] != NULL){ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['file']['type'] == "image/jpeg"
        || $_FILES['file']['type'] == "image/png"
        || $_FILES['file']['type'] == "image/gif"){
        // là file ảnh
        // Tiến hành code upload    
            if($_FILES['file']['size'] > 1048576){
                echo "File không được lớn hơn 1mb";
            }else{
                // file hợp lệ, tiến hành upload
                $path = ""; // nơi lưu file
                $tmp_name = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $type = $_FILES['file']['type']; 
                $size = $_FILES['file']['size']; 
                // Upload file
                move_uploaded_file($tmp_name,$path.$name);
                echo "File uploaded! <br />";
                echo "Tên file : ".$name."<br />";
                echo "Kiểu file : ".$type."<br />";
                echo "File size : ".$size;
                echo "<script type='text/javascript'>alert('Really annoying pop-up!');</script>";
           }
        }else{
           // không phải file ảnh
           echo "Kiểu file không hợp lệ";
        }
   }else{
        echo "Vui lòng chọn file";
   }
}
}

function get_pro($user){
global $db;
// Mầu
try {

$query = 'SELECT * FROM working natural join project natural join tworking
WHERE EId = :user';

$statement = $db->prepare($query);
$statement->bindValue(':user', $user);
$statement->execute();

$pro=$statement->fetchAll();

$statement->closeCursor();

} catch (Exception $e) {

}

return $pro;
}

function get_mon($user){
global $db;
// Mầu
try {

$query = 'SELECT * FROM month
WHERE EId = :user';

$statement = $db->prepare($query);
$statement->bindValue(':user', $user);
$statement->execute();

$mon=$statement->fetchAll();

$statement->closeCursor();

} catch (Exception $e) {

}

return $mon;
}

function get_em(){
global $db;

try {

$query = 'SELECT * FROM employee';

$statement = $db->prepare($query);
$statement->execute();

$em=$statement->fetchAll();

$statement->closeCursor();

} catch (Exception $e) {
echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
}

return $em;
}

function delete_employee($EId){
    global $db;
    try {

        $query = 'DELETE FROM employee
                    WHERE EId=:user' ;

        $statement = $db->prepare($query);
        
        $statement->bindValue(':user', $EId);
        $count=$statement->execute();

        $statement->closeCursor();
        
    } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Xảy ra lỗi với SQL!');</script>";
    }
  
}

function get_id($user){
global $db;
try{
$query = 'SELECT * FROM workfor
WHERE EId = :user';

$statement = $db->prepare($query);
$statement->bindValue(':user', $user);
$statement->execute();

$user=$statement->fetch();

$statement->closeCursor();
} catch (Exception $e){

}
return $user;
}

?>