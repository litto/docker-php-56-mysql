<?php

include"db.php";



$sql=mysql_query("UPDATE `cms_partners` set status='1' Where id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

location.reload();

</script>