<p>Here is a list of all your friends:</p>

<?php foreach($friends as $friend) { ?>
  	<p>
	    <?php echo $friend->first_name; ?>
	    <a href='?controller=friends&action=show&id=<?php echo $friend->id; ?>'>See More...</a>
  	</p>
<?php } ?>