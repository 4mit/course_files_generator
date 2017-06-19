<?php
//session_destroy();
setcookie("id","",time()-7200,"/");
setcookie("referer","",time()-7200,"/");
echo "<script>top.location.href = 'index.php' ;</script>";
?>