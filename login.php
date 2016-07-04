<?php 

include 'is_valid_access.php';

$conf = $_SESSION['conf'];
$ldap = $_POST['username'];
$pass = $_POST['pass'];

$_SESSION['AUTHENTICATED'] = FALSE;

/* continue */
$conn = imap_open( "{imap.ncbs.res.in}INBOX", $ldap, $pass, OP_HALFOPEN );
if(!$conn) 
{
    echo printErrorSevere("FATAL : Username or password is incorrect.");
    goToPage("index.php", 3);
}
else 
{
    echo printInfo( "Login successful" );
    imap_close( $conn );
    $_SESSION['AUTHENTICATED'] = TRUE;
    goToPage( "user.php", 0 );
}

?>
