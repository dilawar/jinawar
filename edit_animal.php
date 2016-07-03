<?php

include_once( 'is_valid_access.php' );
include_once( 'sqlite.php' );
include_once( 'error.php' );
include_once( 'header.php' );

/* If there is not animal then go back */

function change( $animal, $what )
{
    $html = "<h3>Changing animal cage ...</h3>";

    if( $what == "cage" )
        $oldval = __get__( $animal, 'current_cage_id', 'Unknown' );
    else if( $what ==  'strain' ) 
        $oldval = __get__( $animal, 'strain', 'Unknown' );
    else
        $oldval = 'Unassigned';

    $html .= "Old $what <font color=\"blue\">" .  $oldval . "</font><br>";
    $html .= "<table id=\"table_input1\">";
    $html .= "<tr><td> New $what </td>";

    if( $what == "cage" )
        $html .= "<td>" . cageIdsToHtml( NULL ) . "</td>";

    if( $what == "strain" )
        $html .= "<td>" . strainsToHtml( ) . "</td>";

    $html .= '<td><input type="submit" name="update" value="Update ' . $what. '"></td></tr>';
    $html .= "</table>";
    return $html;
}

function updateHealth( $animal_id )
{
    $health = getHealth( $animal_id );

    $html = "<table id=\"table_input1\">";
    $html .= ' <tr> 
            <td>Length</td> 
            <td> <input type="number" name="length" value="' . $health['length']. '">mm</input>
            </td> </tr> ';
    $html .= ' <tr> <td>Height</td> 
            <td> 
                <input type="number" name="height" value="' . $health['height'] . '">mm</input>
            </td> </tr> ';
    $html .= ' <tr> 
            <td>Weight</td> 
            <td> <input type="number" name="weight" value="' . $health['weight'] . '">gm</input> </td> 
        </tr> ';
    $html .= ' <tr> 
            <td>Died on</td> 
            <td> <input type="date" name="died_on" id="date_died_on" placeholder=" 
            '. $health['died_on'] . '"></input> </td> 
            <script type="text/javascript" charset="utf-8">
                var dt = new Date();
                var today = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                //document.getElementById("date_died_on").value = today;
            </script>
        </tr> ';
    $html .= ' <tr> 
            <td>Reason of death</td> 
            <td> <textarea type="text" name="deadly_reason">'. $health['deadly_reason'] . '</textarea> </td> 
        </tr> ';
    $html .= '<tr> <td></td> <td>
        <input style="float: right" type="submit" name="update" value="Update Health">
        </td></tr>';
    $html .= "</table>";
    return $html;
}

if( $_POST && $_POST[ 'animal_id']  )
{
    $animal = getAnimalWithId( $_POST['animal_id'] );
    $strain = $animal['strain'];

?>

<h3> Editing/Updating animal </h3>

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

<?php
?>

<!-- Here is default form which sends to edit_animal_action.php file -->
<form method="post" action="edit_animal_action.php">

<?php

    switch( trim($_POST['response']) )
    {

    case "Assign/Change cage":
        echo change( $animal, "cage" );
        break;

    case "Record genotype":
        echo change( $animal, "strain" );
        break;

    case "Update health":
        echo "<h3>Updating health .. </h3>";
        echo "<p> No field is neccessary. But it is expected that you'll 
            update something </p>";
        echo updateHealth( $animal['id'] );
        break;

    default:
        echo printWarning( "Unsupported/unimplemented response " . $_POST["response"] );
        break;

    }

    // Need to send animal_id.
    echo '<input type="hidden" name="animal_id" value="' . $animal['id'] . '" />';
?>
</form>

<form action="user.php">
<input class="logout" type="submit" name="goback" value="Go Back">
</form>

<?php
}
else
{
    echo printInfo( "You did not select any animal");
    echo goBackToPageLink( "user.php" );
}

?>
