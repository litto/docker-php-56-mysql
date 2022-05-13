<?php

include"db.php";



$sql=mysql_query("UPDATE `cms_pages` set published='1' Where page_id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

location.reload();

</script>