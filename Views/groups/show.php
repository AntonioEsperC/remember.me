<br>
<h1>Here is the friend list of the group:</h1>
<br><a class="add_group" href="?controller=groups&action=url_add_friend&group_id=<?php echo $group->id; ?>">Add Friend</a>
<a class="add_group" href="?controller=groups&action=delete_group&group_id=<?php echo $group->id; ?>">Delete Group</a><br><br>

<h2>Name of the group: <?php echo $group->group_name; ?></h2>


<?php foreach($friends as $friend) { ?>
	<div class="col-md-4 col-lg-4 col-sm-4 group">
		<p><?php echo $friend[0] .' '; echo $friend[1]; ?></p>
	</div>
<?php } ?>