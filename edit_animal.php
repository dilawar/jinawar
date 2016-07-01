<?php

include_once( 'is_valid_access.php' );
include_once( 'sqlite.php' );
include_once( 'error.php' );
include_once( 'header.php' );

var_dump( $_POST );
$animal = getAnimalWithId( $_POST['animal_id'] );
$strain = $animal['strain'];

?>

<h3> Editing/Updating animal </h3>

<table id="table_input" >

<form method="post" action="insert_animal_action.php" id="form_insert_animal" >
<table  id = "table_input" >
<tr>
    <td>ID of the animal </td>
    <td> <?php echo $_POST['animal_id']; ?> </td>
</tr>
<tr>
    <td>Name of the animal <br> </td>
    <td> <?php echo $animal['name']; ?> </td>
</tr>
<tr>
    <td>Date of birth <br> <small> YYYY-MM-DD </small> </td>
    <td> <?php echo $animal['dob'] ?> </td>
</tr>
<tr>
    <td>Gender</td>
    <td> <?php echo $animal['gender']; ?> </td>
</tr>
<tr>
    <td>Strain </td>
    <td> <?php echo $animal['strain'] ?> </td>
</tr>
<tr>
    <td>Parent cage ID<br><small>Animal was born in this cage</small></td> 
    <td> <?php echo $animal['parent_cage_id'] ?: "UNKNOWN"; ?> </td>
</tr>
<tr>
</table>

<!-- Conditional update -->

<?php

function change( $animal, $what )
{
    $html = "<h3>Changing animal cage ...</h3>";
    if( $what == "cage" )
    {
        if( array_key_exists('current_cage_id', $animal ) )
            $oldval = $animal['current_cage_id'];
        else
            $oldval = 'Unassigned';
    }

    $html .= "Old $what  <font color=\"blue\">" .  $oldval . "</font><br>";
    $html .= "<table id=\"table_input1\">";
    $html .= "<tr><td> New $what </td>";

    if( $what == "cage" )
        $html .= "<td>" . cageIdsToHtml( NULL ) . "</td>";

    $html .= '<td><input type="submit" name="insert" value="Insert"></td></tr>';
    $html .= "</table>";
    return $html;
}

?>

<form action="edit_animal_action.php">

<?php

switch( $_POST['response'] )
{

case "Assign/Change cage":
    echo change( $animal, "cage" );
    break;

default:
    break;

}
?>
</form>

<form action="user.php">
<input class="logout" type="submit" name="goback" value="Go Back">
</form>

