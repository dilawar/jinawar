<?php

include_once('ldap.php');
function sqlite_open($location)
{
  $db = new SQLite3($location);
  return $db;
}

function getAnimalWithId( $id )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "Could not open $dbname" );
    $res = $conn->query( 'SELECT * FROM animals WHERE id=' . $id );
    $arr = $res->fetchArray( SQLITE3_ASSOC );

    $res = $conn->query( 'SELECT * FROM current_status WHERE id=' . $id );
    $arr1 = $res->fetchArray( SQLITE3_ASSOC );

    $conn->close();

    if( $arr1 )
        $arr = array_merge( $arr + $arr1 );
    return $arr;
}

function getInfoForDisplay()
{
  $conn = sqlite_open("db/jinawar.sqlite");
  $info = array();
  if($conn) 
  {
      $res = $conn->query("SELECT Count(*) FROM mice");
      if($res)
      {
          $arr = $res->fetchArray();
          $info['total_mice'] = $arr[0];
      }
      $conn->close();
  }
  return $info;
}

function getAnimalList( )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "Could not open $dbname" );
    $response = $conn->query( 'SELECT id, name FROM animals' );
    $result = Array();
    $i = 0;
    while( $arr = $response->fetchArray( SQLITE3_BOTH ) )
    {
        $result[$i] = $arr;
        $i ++;
    }

    $conn->close();
    return $result;
}

/**
    * @brief Get the ids for all cages with given type.
    *
    * @param $type
    *
    * @return 
 */
function getListOfCages( $type = NULL )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "failed to open $dbname" );
    $array = Array();
    if( $conn )
    {
        if( $type )
            $res = $conn->query( 'SELECT * FROM cages WHERE type="'. $type . '"' );
        else
            $res = $conn->query( 'SELECT * FROM cages' );

        $i = 0;
        while( $row = $res->fetchArray( SQLITE3_ASSOC ) )
        {
            $array[$i] = $row;
            $i++;
        }
        $conn->close();
    }
    return $array;
}

function summaryTable( )
{
    $html = "<table id=\"table_info\" style=\"float: left\">";
    $animals = getAnimalList( );
    $breederCages = getListOfCages( "breeder" );
    $cages = getListOfCages( );
    $numAnimals = sizeof( $breederCages );
    $numCages = sizeof( $cages );
    $numBreederCages = sizeof( $breederCages );
    $html .= "<tr> <td>No of animals </td><td> $numAnimals </td> </tr>";
    $html .= "<tr> <td>No of all cages </td><td> $numCages </td> </tr>";
    $html .= "<tr> <td>No of breeder cages </td><td> $numBreederCages </td> </tr>";
    $html .= "</table>";
    return $html;
}

?>

