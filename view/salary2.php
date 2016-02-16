<?php include 'inc/config.php'; // Configuration php file ?>
<?php include 'inc/top.php'; // Meta data and header ?>
<?php include 'inc/side.php'; // Navigation content ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
<h1><i class="glyphicon-wallet themed-color"></i>Bảng lương<br><small>Bảng lương của các nhân viên</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
<!-- Breadcrumb -->
<!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
<!-- You can try it on other elements too , the sticky position and style can be adjusted in the css/main.css with .affix class -->
<div class="block block-themed">
<!-- Faq Title -->
<div class="block-title">
<h4><?php echo get_name($_SESSION['is_valid']); ?> - <?php $name=pos_dep($_SESSION['is_valid']);
echo $name['Position'].' '.$name['Name'];
?> </small></h4>
</div>
<!-- END Breadcrumb -->
<div class="block-content">
<!-- Faq Tabs -->
<div class="tabs-left clearfix">
<!-- Tab links -->
<ul id="faq-tabs" class="nav nav-tabs" data-toggle="tabs">
<li class="active"><a href="#faq-tabs-section1"><i class="icon-asterisk text-black"></i> <strong>Bảng lương</strong></a></li>
<li><a href="#faq-tabs-section2"><i class="icon-paper-clip text-black"></i> <strong>Lịch sử nhận lương</strong></a></li>
</ul>
<!-- END Tab links -->

<!-- Tabs Content -->
<div class="tab-content">
<!-- First Tab - General -->
<div id="faq-tabs-section1" class="tab-pane active">
<div id="faq-section1" class="accordion">
<div class="accordion-group">
<div class="accordion-heading">
<form action="view/salary_history.php" method="POST">
<input type="hidden" name="EId" value="<?php echo $_SESSION['is_valid']; ?>">
<table class="table table-bordeless table-hover">
<thead>
<tr>
<th> </th>
<th>Loại lương</th>
<th></th><th></th>
<th></th>
<th class="hidden-phone text-center">Mức lương</th>
<th class="hidden-phone text-center">Thời gian</th>
<th class="text-center">Lương</th>
</tr>
</thead>
<tbody>
<tr>
	<?php $check=0; ?>
	<?php if($check==0) { ?>
<td>1</td>
<td><strong>Lương cơ bản tháng 12</strong>
<input type="hidden" name="luongcoban" value="Lương cơ bản tháng 12 <?php $people=get_full($_SESSION['is_valid']); echo $people['BSSalary']?> VNĐ">
</td>
<td></td><td></td>
<td></td>
<td class="hidden-phone text-center"><?php $people=get_full($_SESSION['is_valid']); echo $people['BSSalary']?> VNĐ</td>
<td class="hidden-phone text-center">1 tháng </td>
<td class="text-right"><?php echo $people['BSSalary']?> VNĐ</td>
</tr>
<tr>
<td>2</td>
<td><strong>Phụ cấp đi lại tháng 12</strong>
<input type="hidden" name="phucap" value="Phụ cấp đi lại tháng 12 <?php echo ($people['Distance']*100000)?> VNĐ">
</td>
<td></td><td></td>
<td></td>
<td class="hidden-phone text-center"><?php echo ($people['Distance']*100000)?> VNĐ </td>
<td class="hidden-phone text-center">1 tháng </td>
<td class="text-right"><?php echo ($people['Distance']*100000)?> VNĐ</td>
</tr>

<?php $pro=get_pro($_SESSION['is_valid']);
$n=3;
$s=0;

foreach ($pro as $key => $i){
echo '<tr>';
echo '<td>'.$n.'</td>'; $n=$n+1;
echo '<td><strong>'.'Lương dự án '.$i['Name'].'</strong></td>';
echo '<td>'.''.'</td>';
echo '<td>'.''.'</td>';
echo '<td>'.''.'</td>';
echo '<td class="hidden-phone text-center">'.$a=$i['SpH'].' VNĐ'.'</td>';
echo '<td class="hidden-phone text-center">'.$b=((strtotime($i['TTo'])-strtotime($i['TFrom']))/(24*3600)).' ngày'.'</td>';
echo '<td class="hidden-phone text-right">'.$pro_sal=$a*$b.' VNĐ'.'</td>';
echo '<input type="hidden" name="luongduan['.$key.']" value="Lương dự án '.$i['Name'].'<br>">';
echo '</tr>';
$s=$pro_sal+$s;
}
?>


<tr class="info">
<td></td>
<td></td>
<td class="hidden-phone"></td>
<td class="hidden-phone"></td>
<td class="hidden-phone"></td>
<td class="text-right"><strong>Tổng</strong></td>
<td></td>
<td class="text-right"><?php echo (($people['BSSalary']) + ($people['Distance']*100000)) + ($s)?> VNĐ</td>
<input type="hidden" name="sum" value="<?php echo (($people['BSSalary']) + ($people['Distance']*100000)) + ($s)?>">
<?php }?>
</tr>
</tbody>
</table>

</div>
</div>

</div>
</div>
<!-- END First Tab - General -->

<!-- Second Tab - UI -->
<div id="faq-tabs-section2" class="tab-pane">
<div id="faq-section2" class="accordion">
<div class="accordion-group">
<table class="table table-bordeless table-hover">
<thead>
<tr>
<th> </th>
<th>Nội dung</th>
<th></th><th></th>
<th></th>
<th></th>
<th class="hidden-phone text-center">Thời gian</th>
<th class="text-center">Số tiền</th>
</tr>
</thead>
<tbody>
<?php $mon=get_mon($_SESSION['is_valid']);
$n=1;
$s=0;

foreach ($mon as $i){
echo '<tr>';
echo '<td>'.$n.'</td>'; $n=$n+1;
echo '<td><strong>'.$i['Descript'].'</strong></td>';
echo '<td>'.''.'</td>';
echo '<td>'.''.'</td>';
echo '<td>'.''.'</td>';
echo '<td>'.''.'</td>';
echo '<td class="hidden-phone text-center">'.$i['MId'].'</td>';
echo '<td class="hidden-phone text-right">'.$m=$i['Money'].' VNĐ'.'</td>';
echo '</tr>';
$s=$m+$s;
}
?>


<tr class="info">
<td></td>
<td></td>
<td class="hidden-phone"></td>
<td class="hidden-phone"></td>
<td class="hidden-phone"></td>
<td class="text-right"><strong>Tổng</strong></td>
<td></td>
<td class="text-right"><?php echo ($s)?> VNĐ</td>
</tr>
</tbody>
</table>
</div>
<div class="accordion-group">

</div>
</div>
<!-- END Second Tab - UI -->
</div>
<!-- END Tabs Content -->
</div>
<!-- END Faq Tabs -->
</div>

<!-- Invoice Content -->
<!-- Addresses -->
<div class="block-section-pad remove-margin">
<div class="row-fluid">
</td>
</tr>
</tbody>
</table>


</div>

</div>
</div>

</form>
<!-- END Addresses -->
</div>


<!-- Extras -->
<!-- END Invoice Content -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>
