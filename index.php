<!DOCTYPE html>
<?php 
include('header.php');
include('methods.php');
include('tables.php');

session_save_path("/tmp/");
$conf = array();
$inifile = "jinawarrc";
if(file_exists($inifile)) {
	$conf = parse_ini_file($inifile, $process_sections = true );
}

if(!$conf)
{
    $error = "Failed to read  configuartion file.";
    header($error." I can't do anything anymore. Please wake up the admin.");
    exit;
}

$_SESSION['conf'] = $conf;

// Has two tables mice, cages and users.
$_SESSION['db_unmutable'] = 'db/jinawar.sqlite';

// Has multable tables, log, users etc.
$_SESSION['db_mutable'] = 'db/record.sqlite';

/* counter */
$hit_count = (int)file_get_contents('count.txt');
$hit_count++;
file_put_contents('count.txt', $hit_count);

?>

<font size="3" color="black">
<h3>Authentication </h3>
<p> We do not store your password. Your LDAP information is is sent to 
email-server for authentication. </p>

<?php /* Table : Login using ldap.  */ ?>
<?php echo loginTable(); ?>

<!-- TODO: Display summary here -->

<h5> Known issues </h5>
<h5> News and updates </h5>
<?php 
echo "</body></html>";
?>
