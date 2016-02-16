<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-user themed-color"></i><?php echo get_name($_SESSION['view_people']); ?>
        <br><small><?php $name=pos_dep($_SESSION['view_people']); echo $name['Position'].' - '.$name['Name'];
        ?></small></h1>

    
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <?php $people=get_full($_SESSION['view_people']); 

        // Get all informations about people
    ?>
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Thông tin cá nhân</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- User Profile Block -->
    <div class="block block-themed block-last">
        <!-- User Profile Title -->
        <div class="block-title">
            
            <h4>Thông tin cá nhân</h4>
        </div>
        <!-- END User Profile Title -->

        <!-- User Profile Content -->
        <div class="block-content">
            <!-- User Profile Content -->
            <div class="row-fluid">
                <!-- First Column -->
                <div class="span3">
                    <!-- Avatar -->
                    <div class="block-section text-center">
                        <img src=<?php echo get_img($_SESSION['view_people']);?> alt="Avatar" style="padding-right: 40px;width:375px;height=500px; ">
                    </div>

                    <?php if ($_SESSION['view_people']==$_SESSION['is_valid']) { ?>

                        <form action="index.php" method="post" enctype="multipart/form-data">
                            Thay ảnh đại diện:
                            <input type="file" class="btn" name="file"/> 
                            <input type="hidden" name="EId" value="<?php echo $people['EId'];?>">
                            <input type="hidden" name="action" value="UserChangeImage">

                            <button type="submit button" class="btn btn-primary" Name=ok>Thay đổi</button> 
                            <!-- <input type="submit" value="Thay đổi" name="ok"> -->
                        </form>

                    <?php } ?>

                    <!-- END Avatar -->

                    <!-- Thông tin cơ bản -->
                 
                    <!-- END Skills -->

                </div>
                <!-- END First Column -->

                <!-- Second Column -->
                   <div id="profile1" class="span6" style="display:inline">
                        <div class="label label-inverse">Họ tên</div>
                        <p><?php  echo $people['Name']?></p>
                        <div class="label label-inverse">Ngày sinh</div>
                        <p><?php $date = new DateTime($people['DoB']); echo $date->format('d-m-Y');?></p>
                        <div class="label label-inverse">Giới tính</div>
                        <p><?php if ($people['Sex']==1) {
                            echo "Nam";
                        } else {
                            echo "Nữ";
                        }
                            ?></p>
                        <div class="label label-inverse">Địa chỉ</div>
                        <p><?php echo $people['Address'];?></p>
                        <div class="label label-inverse">Số điện thoại</div>
                        <p><?php echo $people['Phone'];?></p>
                        <div class="label label-inverse">Email</div>
                        <p><?php echo $people['Email'];?></p>
                        <p><?php if ($people['PoF']==1) {
                            echo '<div class="label label-inverse">Nhân viên toàn thời gian</div>';
                        } else {
                            echo '<div class="label label-inverse">Nhân viên bán thời gian</div>';
                        }
                        ?></p>



                        <?php if ($_SESSION['view_people']==$_SESSION['is_valid']) { ?>
                        <button type="button" class="btn btn-primary btn-large span3" onclick="Remove()" id="Fixit">Sửa thông tin</button>
                        <?php }?>
                        
                    </div>

                    <!-- Update profile -->

                    <div id="profile2" class="span6" style="display:none">
                        <form action="index.php" method="post">

                            <div class="label label-inverse">Họ tên</div>

                            <p><?php $people=get_full($_SESSION['view_people']); echo $people['Name']?></p>
                            <div class="label label-inverse">Ngày sinh</div>
                            <p><?php $date = new DateTime($people['DoB']); echo $date->format('d-m-Y');?></p>
                            <div class="label label-inverse">Giới tính</div>
                            <p><?php if ($people['Sex']==1) {
                                echo "Nam";
                            } else {
                                echo "Nữ";
                            }
                            ?></p>
                            <div class="label label-inverse">Địa chỉ</div>
                            
                            <p><input type="text" name="UAddress" Placeholder=<?php echo '"'.$people['Address'].'"';?>></p>

                            <div class="label label-inverse">Số điện thoại</div>

                            <p><input type="text" name="UPhone" Placeholder=<?php echo '"'.$people['Phone'].'"';?>></p>

                            <div class="label label-inverse">Email</div>
                            <p><input type="text" name="UEmail" Placeholder=<?php echo '"'.$people['Email'].'"';?>></p>
                            <input class="btn btn-primary btn-large span2" type="submit" name="Submit" value="Update" id="Update">
                            <input type="hidden" name="UUser" value=<?php echo $_SESSION['view_people'];?> >
                            <input type="hidden" name="action" value="UserChangeInformation">


                        </form>
                    </div>
                    <!-- End Update profile -->
                    
                    <?php if ($_SESSION['view_people']==$_SESSION['is_valid']) { ?>
                                                
                        <script type="text/javascript">
                            function Remove(){
                                document.getElementById("profile1").style.display = "none"; 
                                document.getElementById("profile2").style.display = "inline"; 
                                document.getElementById('Fixit').style.display = "none";

                            }

                        </script>

                    <?php } ?>
                <!-- END Second Column -->

                <!-- Third Column -->
               <?php if ($_SESSION['view_people']==$_SESSION['is_valid']) { ?>
                                    
                    <div id="profile1" class="span3 form-group">

                        <form action="index.php" method="post"> 
                            <label>Mật khẩu cũ:</label> <input class="form-control" type="password" name="opwd"> 
                            <label>Mật khẩu mới:</label> <input type="password" class="form-control" name="pwd1">
                            <label>Xác nhận mật khẩu mới:</label> <input type="password" class="form-control" name="pwd2">

                            <button type="submit button" class="btn btn-primary" value="Submit">Sửa</button> 
                            <br>
                            <input type="hidden" name="action" value="change_password">
                        </form>
                       
                        <!--End Change password -->

                    </div>
                <?php }?>
                <!-- End Third Column -->
            </div>
            <!-- END User Profile Content -->
        </div>
        <!-- END User Profile Content -->
    </div>
    <!-- END User Profile Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>