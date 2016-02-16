
<?php 
    
    session_start();
    require_once('model/database.php');
    require_once('secure/authentic.php');
    require_once('model/tool.php');
    require_once('model/mdepartment.php');
    require_once('model/madd_user.php');
    require_once('model/mproject.php');
    
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'show_admin_menu';
    }

    // If the user isn't logged in, force the user to login
    if (!isset($_SESSION['is_valid'])) {
        $action = 'login';
    }

    switch($action) {
        case 'login':    
            if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
                $user = $_POST['login-email'];
                $password = $_POST['login-password'];
            } else {
                $user='';
                $password='';
            }
            

            if (valid_login($user, $password)) {
                $_SESSION['is_valid'] = $user;
                include('view/dashboard.php');
            } else {
                include('view/page_login.php');
            }
            break;

        case 'logout':
            $_SESSION = array();   // Clear all session data from memory
            session_destroy();     // Clean up the session ID
            include('view/page_login.php');
            break;

        case 'show_profile':
            $_SESSION['view_people'] =$_SESSION['is_valid'];
            include ('view/user_profile.php');
            break;
        case 'UserChangeInformation':

            $UUser=$_POST['UUser'];

            $people=get_full($UUser); 

            if (empty($_POST['UAddress'])) {
                $UAddress=$people['Address'];
            } else {
                $UAddress=$_POST['UAddress'];
            }            

            if (empty($_POST['UPhone'])) {
                $UPhone=$people['Phone'];
            } else {
                $UPhone=$_POST['UPhone'];
            }            

            if (empty($_POST['UEmail'])) {
                $UEmail=$people['Email'];
            } else {
                $UEmail=$_POST['UEmail'];
            }            

            UserChangeInformation($UUser,$UAddress,$UPhone,$UEmail);

            include ('view/user_profile.php');
            break;
        case 'show_department':
            include 'view/department.php';
            break;
        case 'show_profile_different':
            $_SESSION['view_people']=$_GET['EId'];
            include ('view/user_profile.php');
            break;

        case 'change_password':
            $old=$_POST['opwd'];
            $new1=$_POST['pwd1'];
            $new2=$_POST['pwd2'];

            changepass($_SESSION['is_valid'],$old,$new1,$new2);
            include ('view/user_profile.php');
            break;
        case 'UserChangeImage':

            if(isset($_POST['ok'])){ 
                if($_FILES['file']['name'] != NULL){ 
                    if($_FILES['file']['type'] == "image/jpeg"){
                        if($_FILES['file']['size'] > 10485760){
                            echo "<script type='text/javascript'>alert('File không được lớn hơn 1Mb');</script>";
                        }else{
                            $path = "img\\employee\\"; 
                            $tmp_name = $_FILES['file']['tmp_name'];
                            $name = $_FILES['file']['name'];
                            $type = $_FILES['file']['type']; 
                            $size = $_FILES['file']['size']; 

                            // Upload file

                            $name=$_POST['EId'].'.jpg';
                            move_uploaded_file($tmp_name,$path.$name);
                            echo "<script type='text/javascript'>alert('Đổi ảnh đại diện thành công!');</script>";
                       }
                    }else{
                        echo "<script type='text/javascript'>alert('Kiểu file không hợp lệ');</script>";
                    }
               }else{
                    echo "<script type='text/javascript'>alert('Vui lòng chọn file!');</script>";
               }}           
            include ('view/user_profile.php');
            break;
        case 'show_salary':
            $_SESSION['view_people'] =$_SESSION['is_valid'];
            include'view/salary2.php';
            break;
        case 'ChangePos':
            $DId=$_POST['Dep'];
            $EId=$_POST['EId'];
            $Pos=$_POST['Position'];

            change_position($EId,$DId,$Pos);
            include 'view/department.php';
            break;

        case 'AddEmployee':
            $DId=$_POST['Dep'];
            $EId=$_POST['EId'];

            add_employee_dep($EId,$DId);
            include 'view/department.php';
            break;

        case 'DeletePos':
            $DId=$_POST['Dep'];
            $EId=$_POST['EId'];

            delete_emp_dep($EId,$DId);
            include 'view/department.php';

            break;

        case 'show_add_user':
            include '/view/add_user.php';
            break;
        case 'add_user':
            $EId=$_POST['EId'];
            $DoB=$_POST['DoB'];
            $Name=$_POST['Name'];
            $Sex=$_POST['Sex'];
            $Address=$_POST['Address'];
            $Email=$_POST['Email'];
            $Distance=$_POST['Distance'];
            $BSSalary=$_POST['BSSalary'];
            $PoF=$_POST['PoF'];
            $pwd=sha1($EId.$_POST['pwd']);

            add_user($EId,$DoB,$Name,$Sex,$Email,$Distance,$BSSalary,$PoF,$pwd);
            include '/view/add_user.php';
            break;
        case 'add_department':
            $Name=$_POST['Name'];
            $Info=$_POST['Info'];
            add_department($Name,$Info);
            include 'view/department.php';
            break;

        case 'delete_department':
            delete_department($_POST['DId']);
            include 'view/department.php';
            break;
        case 'show_project':
            include 'view/project.php';
            break;

        case 'Delete_EP':
            $PId=$_POST["PId"];
            $EId=$_POST["EId"];
            Delete_EP($PId,$EId);
            include 'view/project.php';
            break;

        case 'AddEmpPro':
            
            $EId=$_POST['EId'];
            $PId=$_POST['PId'];
            $Position=$_POST['Position'];
            $SpH=$_POST['SpH'];
     
            AddEmpPro($EId,$PId,$Position,$SpH);
            include 'view/project.php';
            break;
        case 'add_project':
            $DId=$_POST['DId'];
            $Name=$_POST['Name'];
            $Info=$_POST['Info'];

            add_project($DId,$Name,$Info);
            include 'view/project.php';            
            break;
        case 'delete_project':

            $PId=$_POST['PId'];
            delete_project($PId);
            include 'view/project.php';            
            break;
        case 'show_employee':
            include 'view/list.php';
            break;

        case 'delete_employee':
            $EId=$_POST['EId'];
            delete_employee($EId);
            include 'view/list.php';
            break;
        case 'show_chamcong':
            include '/view/chamcong.php';
            break;
        default:
            include 'view/dashboard.php';
            break;
    }
?>


