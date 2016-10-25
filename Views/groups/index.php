<br>
<h1>Here is a list of all your groups of friends:</h1>
<h5>More functionality (adding group image, remove friend from group) will be added for further versions of the application.</h5>

<br>
<a class="add_group" href="?controller=groups&action=url_create">Create New Group</a><br><br>

<?php foreach($groups as $group) { ?>
  	<div class="col-md-4 col-lg-4 col-sm-4 group">
	    <p><?php echo $group->group_name; ?></p>
	    <a href='?controller=groups&action=show&id=<?php echo $group->id; ?>'>Edit Group</a>
  	</div>
<?php } ?>