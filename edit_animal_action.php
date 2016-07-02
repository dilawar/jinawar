<?php

include_once( "is_valid_access.php" );
include_once( "sqlite.php" );
include_once( "error.php" );

//var_dump( $_POST );

$animalId = $_POST['animal_id'];

function update( $what, $value, $animal_id )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "Failed to connect to $dbname" );
    $stmt = $conn->prepare( 
        "INSERT OR REPLACE INTO current_status ( id, $what ) VALUES ( :id, :val )" 
    );

    $stmt->bindValue( ':id', $animal_id, SQLITE3_TEXT );
    $stmt->bindValue( ':val', $value, SQLITE3_TEXT );
    $res = $stmt->execute( );

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
    echo implode( ' ', $_POST );
    echo goBackToPageLink( 'user.php' );
    break;
}

?>
