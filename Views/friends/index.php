<br>
<h1>Here is a list of all your friends:</h1>
<h5>More functionality (editing, adding email or phone) will be added for further versions of the application.</h5>
<br>
<?php 
	$count = 0;
	?>
	<div class="col-lg-3 col-md-3 col-sm-3">
	<?php
	for ($i = $count; $i <= 284; $i++){ ?>
		<h4 style="display: inline !important;"><?php echo $friends[$count]->first_name .' '; echo $friends[$count]->last_name; ?></h4>
		<a style="font-size: 17px;" href='?controller=friends&action=show&id=<?php echo $friends[$count]->id; ?>'>+</a>
		<br><br>
	<?php 
	$count++;
	} 
	?>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
	<?php
	for ($i = $count; $i <= 568; $i++){ ?>
		<h4 style="display: inline !important;"><?php echo $friends[$count]->first_name .' '; echo $friends[$count]->last_name; ?></h4>
		<a style="font-size: 17px;" href='?controller=friends&action=show&id=<?php echo $friends[$count]->id; ?>'>+</a>
		<br><br>
	<?php 
	$count++;
	} 
	?>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
	<?php
	for ($i = $count; $i <= 852; $i++){ ?>
		<h4 style="display: inline !important;"><?php echo $friends[$count]->first_name .' '; echo $friends[$count]->last_name; ?></h4>
		<a style="font-size: 17px;" href='?controller=friends&action=show&id=<?php echo $friends[$count]->id; ?>'>+</a>
		<br><br>
	<?php 
	$count++;
	} 
	?>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
	<?php
	for ($i = $count; $i <= 1136; $i++){ ?>
		<h4 style="display: inline !important;"><?php echo $friends[$count]->first_name .' '; echo $friends[$count]->last_name; ?></h4>
		<a style="font-size: 17px;" href='?controller=friends&action=show&id=<?php echo $friends[$count]->id; ?>'>+</a>
		<br><br>
	<?php 
	$count++;
	} 
	?>
	</div>
?>