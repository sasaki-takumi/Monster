<?php
	$i = 0;
	foreach ($tweets as $val) {
		foreach ($val as $val2) {
			if(!empty($val2->user->profile_image_url)){
				?>
				<img src= '<?php echo $val2->user->profile_image_url ?>' width='50' height='50'>
				<?php
			}
			if(!empty($val2->user->name)){
				echo $val2->user->name;
			}
			if(!empty($val2->user->screen_name)){
				echo "　@".$val2->user->screen_name."<br />";
			}
			if(!empty($val2->text)){
				echo $val2->text."<br />";
			}
			echo "<hr />";
		}
	}
?>