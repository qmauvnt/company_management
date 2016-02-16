<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>
<?php require_once('model/mdepartment.php');?>
    
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-more_items themed-color"></i>Chấm công<br><small></small></h1>
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
        <li class="active"><a href="">Chấm công</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default Tabs Block -->

    <?php 
    $dep_auth=get_dep_auth($_SESSION['is_valid']);
    $not_in_dep=get_not_in_dep();
    $i=$dep_auth;

    if ($i['Authority']>=5) {
         $work=get_name_pos($i['DId']);


        echo '<div class="panel panel-default">';
        echo '<table class="table">';
        echo "<tr>";
        echo " <th>Tên</th> <th>Vị trí</th>";


        echo "</tr>";

        echo "</table>";
    }

    ?>

    <a href=""></a>

</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>