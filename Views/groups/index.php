<br><a href="?controller=groups&action=url_create">Create New Group</a><br>

<p>Here is a list of all your groups:</p>

<?php foreach($groups as $group) { ?>
  	<p>
	    <?php echo $group->group_name; ?>
	    <a href='?controller=groups&action=show&id=<?php echo $group->id; ?>'>Manage this group</a>
  	</p>
<?php } ?>