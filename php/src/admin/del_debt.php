<?php

include"db.php";



$sql=mysql_query("DELETE  FROM  `cms_debtenquirys` Where id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

window.location.assign("debtlist.php");

</script>