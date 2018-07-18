
<div class="container" style="position:absolute; margin-top: 20px;margin-left: 8.6%;margin-bottom: 20px;z-index:1">
<div class="row col-md-12">
<?php $link = array(); ?>

<?php foreach ($breadcrumbs as $key => $value): ?>
	<?php $link[]  = '<a href="'.$key.'">'.$value.'</a>'?>
<?php endforeach ?>
<?php 
echo '<div class="breadcrumb">'.implode($link, ' / ').'</div>';
 ?>
 </div>
 <div class="clearfix"></div>
 </div>
 