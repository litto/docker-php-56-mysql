<?php

include"db.php";



$sql=mysql_query("UPDATE `cms_products` set publish='0' Where id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

window.location.assign("productlist.php");

</script>