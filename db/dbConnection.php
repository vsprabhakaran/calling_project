<?php
function db_prelude(&$con)
{
    $con = new mysqli("localhost", "root", "", "ccpc_hvt_instruments");
    if ($con->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>
