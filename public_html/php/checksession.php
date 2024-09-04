<?php
session_start();
if (!isset($_SESSION["session_id"]) && !isset($_SESSION["session_user"])) {
    header("location: ../error.php");
}
