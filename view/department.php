<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>
<?php require_once('model/mdepartment.php');?>
    
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-more_items themed-color"></i>Phòng ban<br><small>Danh sách các phòng ban trực thuộc công ty</small></h1>
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
        <li class="active"><a href="">Phòng ban</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default Tabs Block -->

    <?php $name=get_dep();
    $dep_auth=get_dep_auth($_SESSION['is_valid']);

    $not_in_dep=get_not_in_dep();

    foreach ($name as $i ) {
        

        echo '<div class="block block-themed">';
        echo '<div class="block-title">';
            echo '<h4>'.$i['Name'].'</h4>';
        echo '</div>';

        echo '<div class="label label-inverse">Thông tin</div>';
        echo '<p>'.$i['Info'].'</p>';

        // Check quyền hạn
        // if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2)) {
        // }

        echo '<div class="label label-inverse">Nhân viên</div>';

        $work=get_name_pos($i['DId']);


        echo '<div class="panel panel-default">';
        echo '<table class="table">';
        echo "<tr>";
        echo " <th>Tên</th> <th>Vị trí</th>";

        if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2)|| ($dep_auth['Authority']>=4)) {
            echo "<th> Bổ nhiệm <th>";
            echo "<th> Xóa <th>";
        }

        echo "</tr>";


        foreach ($work as $namepos) {
            echo "<tr>";
            echo '<td><a href=?action=show_profile_different&EId='.$namepos['EId'].'>'.$namepos['Name'].'</a></td>';
            echo '<td> '.$namepos['Position'].'</td>';


            if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2) || ($dep_auth['Authority']>=4)) {
                echo "<td>";
                
                echo "<form action='index.php' method='post'>";

                echo '<input type="hidden" name="action" value="ChangePos">';
                echo '<input type="hidden" name="Dep" value='.$i['DId'].'>';
                echo '<input type="hidden" name="EId" value='.$namepos['EId'].'>';
            
                echo '<select name="Position"';
                echo ">";

                $pos=get_pos();
                foreach ($pos as $j) 
                    if (($j['Authority'] <= $dep_auth['Authority'])&&($j['Authority']<=$i['LimitAuth'])) {
                        echo '<option value='.'"'.$j['Id'].'"';

                        if ($j['Id']==$namepos['Id']) {
                            echo 'selected=selected';
                        }
                        echo ">";
                        echo $j['Position']."</option>";
                    }

                echo "</select>";
                echo '<input class="btn btn-primary" type="submit" value="Sửa" id="update">';
                echo "</form>";
                echo "</td>";

                echo "<td>";
                echo "</td>";
                echo "<td>";

                echo "<form action='index.php' method='post'>";
                echo '<input type="hidden" name="action" value="DeletePos">';
                echo '<input type="hidden" name="Dep" value='.$i['DId'].'>';
                echo '<input type="hidden" name="EId" value='.$namepos['EId'].'>';


                echo '<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-remove"></span></button>';
                
                // echo '<input class="btn btn-primary" type="submit" value="Xóa" id="update">';
                echo "</form>";

                echo "</td>";

            }

            echo "</tr>";
        }

        echo "</table>";

        // Bổ sung nhân viên
        if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2)|| ($dep_auth['Authority']>=4)) {
                
            echo "Thêm nhân viên: ";


            echo "<form action='index.php' method='post'>";

            echo '<input type="hidden" name="action" value="AddEmployee">';
            echo "<input type='hidden' name='Dep' value=".$i['DId'].">";
            
            
            echo "<select name='EId'>";

            foreach ($not_in_dep as $idnv) {
                echo "<option value=".$idnv['EId'].'>';
                echo get_full($idnv['EId'])['Name'];
                echo "</option>";
            }
            echo "</select>";

            echo '<input class="btn btn-primary span1" type="submit"  name="Submit" value="Thêm" id="Update">';

            echo "</form>";
        }

        echo "</div>";
        // <p>
        //     ád
        // </p>
        // <div class="label label-inverse">Dự án</div>
        // <p>
        //     abs
        // </p>

    echo '</div>';

    if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2)|| ($dep_auth['Authority']>=4)) {

            echo "<form action='index.php' id='inputform' method='post' class='form-horizontal' >";
            echo '<input type="hidden" name="action" value="delete_department">';
            echo '<input type="hidden" name="DId" value='.$i['DId'].'>';
            echo '<div><input class="btn btn-primary span2" type="submit"  name="Submit" value="Xóa phòng ban" ></div>';

            echo "<br>";
            echo "</form>";
        }

    }
            if ($dep_auth['Authority']>=4) {
            echo '<div class="block block-themed">';
            
            echo '<div class="block-title">';

            echo "<form action='index.php' id='inputform' method='post' class='form-horizontal' >";
            echo '<input type="hidden" name="action" value="add_department">';

        
            echo  '<h4><input type="text" id="general-text" name="Name" placeholder="Tên phòng ban" ></h4>';
            
            echo '</div>';

                echo '<div class="label label-inverse">Thông tin</div>';
                echo '<div><input type="text" id="general-text" name="Info" ></div>';
                
                echo '<div><select id="general-select" name="Authority" size="1">';
                    echo '<option value="2">Chuyên môn</option>';
                    echo '<option value="4">Quản lý</option>';
                        echo '</select></div>';

                echo '<input class="btn btn-primary span1" type="submit"  name="Submit" value="Thêm" >';
                
            echo "</form>";

            
            echo '</div>';
        }

    ?>



    <a href=""></a>

</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>