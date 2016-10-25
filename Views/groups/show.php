<br><a href="?controller=groups&action=url_add_friend&group_id=<?php echo $group->id; ?>">Add friend to this group</a>
<a href="?controller=groups&action=delete_group&group_id=<?php echo $group->id; ?>">Delete group</a>

<p>This is the information of the group:</p> 

<p>Name: <?php echo $group->group_name; ?></p>

<ul>
	<?php foreach($friends as $friend) { ?>
		<li>First name: <?php echo $friend[0]; ?>  Last name: <?php echo $friend[1]; ?></li>
	<?php } ?>
</ul>