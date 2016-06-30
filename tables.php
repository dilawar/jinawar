<?php 
/**
 * This table is login-table */
function loginTable()
{
  $conf = $_SESSION['conf'];
  /* Check if ldap server is alive. */
  $table = "";
  $table .= '<table id="table_login_main">';
  $table .= '<form action="login.php" method="post">';
  $table .= '<tr><td><small>NCBS Username</small> </td></tr> ';
  $table .= '<tr><td><input type="text" name="username" id="username" /> </td></tr>';
  $table .= '<tr><td><small>NCBS Password</small></td></tr>';
  $table .= '<tr><td> <input type="password"  name="pass" id="pass"> </td></tr>';
  $table .= '<table id="table_server">';
  $table .= '</table>';
  $table .= '<input class="login" type="submit" name="response" value="Login" />';
  $table .= '</form>';
  $table .= '</table>';
  return $table;
}

?>
