<?php 
if (isset($_POST["submit"])) {
  $username = checkInput( $_POST["username"]);
  $pwd = checkInput($_POST["pwd"]);
}