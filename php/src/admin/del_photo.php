<?php

include"db.php";



$sql=mysql_query("DELETE  FROM  `cms_image` Where image_id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

location.reload();

</script>