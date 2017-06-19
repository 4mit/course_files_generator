<?php
	if(isset($_COOKIE['id']))
		if((strtoupper($_COOKIE['id'])) == 'ADMIN' )
		{

		}
		else
		{
?>
<script>
		location.href = 'index.php#login';
	</script>
<?php
		}
	else
		{
?>
<script>
		location.href = 'index.php#login';
	</script>
<?php

		}
?>
