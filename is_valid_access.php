<?php

include_once( "header.php" );
include_once( 'methods.php' );

if( $_SESSION['AUTHENTICATED'] == FALSE ) 
{
    echo printWarning( "You should not be here. Not authenticated" );
    goToPage( "jinawar/index.php", 3 );
}

?>
