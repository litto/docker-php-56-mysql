<?php

include"db.php";



$sql=mysql_query("DELETE  FROM  `cms_album` Where album_id='$_GET[id]'") or die('Error1:'.mysql_error());



?>

<script type="text/javascript">

window.location.assign("albumlisting.php");

</script>