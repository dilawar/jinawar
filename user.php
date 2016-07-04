<?php 

include_once( "is_valid_access.php" );
include_once( "methods.php" );

$animals = getAnimalList( );
$animalDataList = animalsToDataList( $animals );

// List of taks a user can do.
?>

 <table id="table_action">
  <tr align="center">
    <td> 
        <form method="post" action="insert_cage.php">
            <input type="submit" name="response" value="Insert new cage" >
        </form>
    </td>
    <td> 
        <form method="post" action="insert_animal.php">
            <input type="submit" name="response" value="Insert new animal" >
        </form>
    </td>
    </tr>
</table>
<br />

<form method="post" action="user_show_animal_info.php" id="form_show_animnal">
</form>

<form method="post" action="edit_animal.php" id="form_edit_animal">
<table id="table_action">
  <tr>
    <td valign="top"> <?php echo $animalDataList; ?> 
        <input list="animal_list" name="animal_id"  placeholder="Pick an animal" required>
    </td>
    <td>
        <select name="response">
            <option disable selected value>Pick a task </option>
            <option value="Assign/Change cage">Assign/Change cage</option>
            <option value="Update Health">Update Health</option>
            <option value="Record Genotype">Record Genotype</option>
        </select>
        <input type="submit" name="edit_animal" id="" value="Submit" />
    </td>
</table> 
</form>

<form method="post" action="index.php">

<input class="logout" type="submit" name="submit" value="Log Out">
<?php unset($_SESSION); ?>
</form>
