<form action="?controller=groups&action=add_friend&group_id=<?php echo $group->id;?>" method="post">
  	<br>Select friend:<br>
  	<select name="friend_id">
	  	<?php foreach($friends as $friend) { ?>
	  		<option value=<?php echo '"'.$friend->id.'"'  ?>>
	  			<?php echo $friend->first_name .' '. $friend->last_name; ?>
	  		</option>
		<?php } ?>
  	</select>
  	<br><br>
  	<input type="submit" value="Submit">
</form>