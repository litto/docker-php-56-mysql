<?php

include"db.php";



$sql=mysql_query("UPDATE `cms_album` set status='1' Where album_id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

window.location.assign("albumlisting.php");

</script>