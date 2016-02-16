<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>
<?php require_once('model/tool.php');?>
    
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-magnet themed-color"></i> Danh sách nhân viên<br><small>Danh sách toàn bộ nhân viên</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"></span>
        </li>
        <li>
        <i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Danh sách nhân viên</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php $dep_auth=get_dep_auth($_SESSION['is_valid']);?>
    <!-- Dynamic Tables Section -->
    <div class="block-section">
        <table id="example-datatables" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="span1 text-center hidden-phone">#</th>
                    <th><i class="icon-user"></i> Tên nhân viên</th>
                    <th class="hidden-phone "> Chức vụ</th>
                    
                    <?php if ($dep_auth['Authority']==5) 
                        {
                        echo '<th class="span2 ">Xuất lương</th>';} ?>

                    <?php if ($dep_auth['Authority']>=4) 
                        {
                        echo '<th class="span1 text-center">Xóa</th>';} ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $labels['0']['class'] = "";
                $labels['0']['text'] = "Inactive";
                $labels['1']['class'] = "label-success";
                $labels['1']['text'] = "Approved!";
                $labels['2']['class'] = "label-important";
                $labels['2']['text'] = "Unapproved";
                $labels['3']['class'] = "label-warning";
                $labels['3']['text'] = "Pending..";
                $labels['4']['class'] = "label-info";
                $labels['4']['text'] = "Manual Approval";
                $labels['5']['class'] = "label-inverse";
                $labels['5']['text'] = "Spam Account";
                ?>

                <?php $em=get_em();
                // var_dump(;die;
                foreach ($em as $key => $i){

                echo '<tr>';
                echo '<td class="span1 text-center hidden-phone">'.($key+1).'</td>';
                
                echo '<td><a href=?action=show_profile_different&EId='.$i['EId'].'>'.$i['Name'].'</a></td>';
                echo '<td class="hidden-phone hidden-tablet">';
                
                $name=pos_dep($i['EId']); 
                echo $name['Position'].' - '.$name['Name'];

                if ($dep_auth['Authority']==5) { 
                    echo '</td>';
                    echo '<td class="span1 text-center">';
                    echo '<div class="btn-group">';
                    echo'        </div>';
                    echo '   </td>';
                }
                
                // Xóa nhân viên
                if ($dep_auth['Authority']>=4) {
                    # code...

                echo "<td>";
                echo "<form action='index.php' id='inputform' method='post' class='form-horizontal' >";
                echo '<input type="hidden" name="action" value="delete_employee">';
                echo '<input type="hidden" name="EId" value='.$i['EId'].'>';
                echo '<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-remove"></span></button>';

                echo "<br>";
                echo "</form>";
                // Xóa nhân viên
                echo "</td>";
                }

                echo '</tr>';}
                ?>
            </tbody>
        </table>
    </div>
    <!-- END Dynamic Tables Section -->
    <?php if ($dep_auth['Authority']>=4) {?>
    <form action='index.php' method='post'>
        <input type="hidden" name="action" value="show_add_user">

        <button type="button submit" class="btn btn-default" >Thêm nhân viên</button>


    </form>
    <?php }?>

</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* Initialize Datatables */
        
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>