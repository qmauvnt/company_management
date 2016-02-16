<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>
<?php require_once 'model/madd_user.php' ?>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-nameplate_alt themed-color"></i> Thêm nhân viên</h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>

        <li class="active"><a href="">Thêm nhân viên</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- General Forms Block -->
    <div class="block block-themed block-last">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4>Bảng kê khai thông tin nhân viên</h4>
        </div>
        <!-- END General Forms Title -->

        <!-- General Forms Content -->
        <div class="block-content">
            <form action="index.php" id='inputform' method="post" class="form-horizontal" >
                <!-- Default Inputs -->
                <input type="hidden" name="action" value="add_user">

                <div class="control-group">
                    <label class="control-label" for="general-text">Mã số nhân viên</label>
                    
                    <?php $EId=get_next_eid();?>

                    <div class="controls">
                        <input type="text" id="general-text" name="EId" readonly value=<?php echo $EId; ?> >
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="general-text">Họ tên</label>
                    <div class="controls">
                        <input type="text" id="Name" name="Name">
                    </div>
                </div>

                <!-- Ngày sinh -->

                <div class="control-group">
                    <label class="control-label" for="general-text">Ngày sinh</label>
                    <div class="controls">
                        <input type="text" id="calendar" name="DoB">
                    </div>
                </div>

                <script>   
                    $(function() {
                        $( "#calendar" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();   
                    }); 
                </script>

                <!-- Kết thúc ngày sinh -->

                <div class="control-group">
                    <label class="control-label" for="general-select">Giới tính</label>
                    <div class="controls">
                        <select id="general-select" name="Sex" size="1">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="general-text">Địa chỉ</label>
                    <div class="controls">
                        <input type="text" id="Name" name="Address">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="general-text">Số điện thoại</label>
                    <div class="controls">
                        <input type="text" id="Name" name="Phone">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="general-text">Email</label>
                    <div class="controls">
                        <input type="text" id="Name" name="Email">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="general-text">Khoảng cách tới công ty</label>
                    <div class="controls">
                        <input type="text" id="Name" name="Distance">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="general-text">Mức lương cơ bản</label>
                    <div class="controls">
                        <input type="text" id="Name" name="BSSalary">
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="general-select">Hình thức làm việc</label>
                    <div class="controls">
                        <select id="general-select" name="PoF" size="1">
                            <option value="1">Toàn thời gian</option>
                            <option value="0">Bán thời gian</option>
                        </select>
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="general-password">Mật khẩu</label>
                    <div class="controls">
                        <input type="password" id="general-password" name="pwd">
                    </div>
                </div>
               
                <!-- END Default Inputs -->

              
                <!-- Form Buttons -->
                <div class="form-actions">
                    <button onclick="reset()" class="btn btn-danger"><i class="icon-repeat"></i>Nhập lại</button>
                    <script type="text/javascript">
                        function reset(){
                            document.getElementById("inputform").reset();
                        }
                    </script>

                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>

                <!-- END Form Buttons -->
            </form>
        </div>
        <!-- END General Forms Content -->
    </div>
    <!-- END General Forms Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>