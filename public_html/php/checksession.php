<?php
if (!isset($_SESSION["session_id"]) && !isset($_SESSION["session_user"])) {
    header("location: /login.php");
}
