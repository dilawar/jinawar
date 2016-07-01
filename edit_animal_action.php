<?php

include_once( "is_valid_access.php" );
include_once( "sqlite.php" );
include_once( "error.php" );

$animalId = $_POST['animal_id'];

function update( $what, $value, $animal_id )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "Failed to connect to $dbname" );
    $res = $conn->query( 
        "INSERT OR REPLACE INTO current_status ( id, $what )
             VALUES ( '$animal_id', '$value' )" );
    $conn->close();
    if( $res ) 
        return true;
    return false;
}

switch( trim($_POST['update']) ) 
{

case "Update cage":
    $cageId = $_POST['cage_id'];
    if( update( 'current_cage_id', $cageId, $animalId ) )
    {
        echo printInfo( "Successfully udpated." );
        goToPage( "user.php", 1 );
    }
    else
    {
        echo printWarning( "Could not update the cage" );
        echo goBackToPageLink( "user.php" );
    }
    break;

case "Update health":
    echo printInfo( "Is not implemented yet" );
    echo '<a href="user.php">Go back</a>';
    break;

case "Update strain":
    $strain = $_POST['animal_strain'];
    if( update( 'strain', $strain, $animalId ) )
    {
        echo printInfo( "Successfully updated" );
        goToPage( "user.php", 1 );
    }
    else
    {
        echo printWarning( "Could not update the cage" );
        echo goBackToPageLink( "user.php" );
    }
    break;


default:
    echo printWarning( "Unknown update operation ".  $_POST['update'] );
    echo '<a href="user.php">Go back</a>';
    break;
}

?>
