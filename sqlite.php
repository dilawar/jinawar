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
    $conn->close();
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
function get_list_of_cages( $type )
{
    $dbname = $_SESSION['db_unmutable'];
    $conn = sqlite_open( $dbname ) or die( "failed to open $dbname" );
    $array = Array();
    if( $conn )
    {
        if( $type )
            $res = $conn->query( 'SELECT DISTINCT id FROM cages WHERE type="'. $type . '"' );
        else
            $res = $conn->query( 'SELECT DISTINCT id FROM cages' );

        $i = 0;
        while( $row = $res->fetchArray( SQLITE3_NUM ) )
        {
            $array[$i] = $row[0];
            $i++;
        }
        $conn->close();
    }
    return $array;
}

?>

