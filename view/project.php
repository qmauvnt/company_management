<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>
<?php require_once('model/mproject.php');?>
    
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-more_items themed-color"></i>Dự án<br><small>Danh sách các dự án công ty </small></h1>
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
        <li class="active"><a href="">Dự án</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default Tabs Block -->

    <?php $name=get_project();

    $get_nv=get_em();

    $dep_auth=get_dep_auth($_SESSION['is_valid']);

    foreach ($name as $i ) {
    
    echo '<div class="block block-themed">';
        echo '<div class="block-title">';
            echo '<h4>'.$i['Name'].'</h4>';
        echo '</div>';

        echo '<div class="label label-inverse">Thông tin dự án</div>';
        echo '<p>'.$i['Info'].'</p>';

        echo '<div class="label label-inverse">Phòng quản lý</div>';
        $x=dep_name($i['PId']);
        echo '<p>'.$x.'</p>';

        if ((checkEP($_SESSION['is_valid'],$i['PId'])!=0) ) {
            echo '<div class="label label-inverse">Mức lương của bạn</div>';
            echo '<p>'.checkEPMoney($_SESSION['is_valid'],$i['PId'])['SpH'].'</p>';
        }

        echo '<div class="label label-inverse">Nhân viên</div>';

        $work=get_name_pospro($i['PId']);
    
        echo '<div class="panel panel-default">';
        echo '<table class="table">';
        echo "<tr> <th>Tên</th> <th>Vị trí</th>";
        if ((checkEP($_SESSION['is_valid'],$i['PId'])==3) OR($dep_auth['Authority']>=4)) {
            echo "<th>Xóa</th>";
        }
        echo "</tr>";



        foreach ($work as $namepos) {
            echo "<tr>";
            echo '<td><a href=?action=show_profile_different&EId='.$namepos['EId'].'>'.$namepos['Name'].'</a></td>';
            echo '<td> ' .$namepos['Position'].'</td>';
            
            if ((checkEP($_SESSION['is_valid'],$i['PId'])==3) OR($dep_auth['Authority']>=4)) {
                echo "<td>";
                echo "<form action='index.php' method='post'>";
                echo '<input type="hidden" name="action" value="Delete_EP">';
                echo '<input type="hidden" name="PId" value='.$i['PId'].'>';
                echo '<input type="hidden" name="EId" value='.$namepos['EId'].'>';


                echo '<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-remove"></span></button>';
                
                // echo '<input class="btn btn-primary" type="submit" value="Xóa" id="update">';
                echo "</form>";
                echo "</td>";
            }

            echo "</tr>";
        }

        echo "</table>";

        //Bổ sung thêm nhân viên
        if ((checkEP($_SESSION['is_valid'],$i['PId'])==3) OR($dep_auth['Authority']>=4)) {
            echo "Thêm nhân viên: ";


            echo "<form action='index.php' method='post'>";

            echo '<input type="hidden" name="action" value="AddEmpPro">';

            echo "<input type='hidden' name='PId' value=".$i['PId'].">";
            
            
            echo "<select name='EId'>";

            foreach ($get_nv as $idnv) {
                echo "<option value=".$idnv['EId'].'>';
                echo get_full($idnv['EId'])['Name'];
                echo "</option>";
            }
            echo "</select>";

            // ------------

            echo "<select name='Position'>";

            $get_pos=get_position(1,3);

            foreach ($get_pos as $idnv) {
                echo "<option value=".$idnv['Id'].'>';
                echo $idnv['Position'];
                echo "</option>";
            }
            echo "</select>";

            echo  '<input type="text" id="general-text" name="SpH" placeholder="Tiền công/ngày" >';
            ///////////////////

            echo '<input class="btn btn-primary span1" type="submit"  name="Submit" value="Thêm" id="Update">';

            echo "</form>";
        }

        echo "</div>";
        
         if (($dep_auth['DId']==$i['DId']) && ($dep_auth['Authority']>=2)|| ($dep_auth['Authority']>=4)) {
                echo "<form action='index.php' id='inputform' method='post' class='form-horizontal' >";
                echo '<input type="hidden" name="action" value="delete_project">';
                echo '<input type="hidden" name="PId" value='.$i['PId'].'>';
                echo '<div><input class="btn btn-primary span2" type="submit"  name="Submit" value="Xóa dự án" ></div>';

                echo "<br>";
                echo "</form>";

        }

    echo '</div>';
    }
     if ($dep_auth['Authority']>=4) {
            echo '<div class="block block-themed">';
            
            echo '<div class="block-title">';

            echo "<form action='index.php' id='inputform' method='post' class='form-horizontal' >";
            echo '<input type="hidden" name="action" value="add_project">';

        
            echo  '<h4><input type="text" id="general-text" name="Name" placeholder="Tên dự án" ></h4>';
            
            echo '</div>';

                echo '<div class="label label-inverse">Thông tin</div>';
                echo '<div><textarea name="Info" form="inputform">Thông tin dự án</textarea></div>';
                
                $phong=get_dep();

                echo '<div><select id="general-select" name="DId" size="1">';

                foreach ($phong as $key ) {
                    echo '<option value='.$key['DId'].'>';
                    echo $key['Name'];
                    echo '</option>';

                }

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