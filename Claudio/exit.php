<?php
session_start();

unset ($_SESSION['auth']);
echo "<h1>Log OUT effettuato! reindirizzamento...</h1>";
header('Refresh: 1; ./index.php' );

?>