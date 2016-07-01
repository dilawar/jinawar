<?php
include_once( 'is_valid_access.php' );
include_once( 'methods.php' );
?>

<h3> Inserting a new animal </h3>
<form method="post" action="insert_animal_action.php" id="form_insert_animal" >
<table  id = "table_input" >
<tr>
    <td>ID of the animal <br> <small> TODO: pattern </small> </td>
    <td> <input type="text" name="animal_id" value="" > </td>
</tr>
<tr>
    <td>Name of the animal <br> <small> Optional</small> </td>
    <td> <input type="text" name="animal_name" value="" > </td>
</tr>
<tr>
    <td>Date of birth <br> <small> YYYY-MM-DD </small> </td>
    <td> <input type="date" name="animal_dob"  value="" > </td>
</tr>
<tr>
    <td>Gender</td>
    <td> 
        <input type="radio" name = "animal_gender" value="male" checked >male</input>
        <input type="radio" name = "animal_gender" value="male" >female</input>
        <input type="radio" name = "animal_gender" value="other" >other</input>
    </td>
</tr>
<tr>
    <td>Strain</td>
    <td>  <?php echo strainsToHtml( ) ?> </td>
</tr>
<tr>
    <td>Cage ID<br><small>Animal was born in this cage</small></td> 
    <td> <?php echo cageIdsToHtml( $type = "breeder" ); ?> </td>
</tr>
<tr>
    <td>Comment </td>
    <td> 
        <textarea  rows="3" cols="40" name="animal_comment" form_id="form_insert_animal"> 
        </textarea>
    </td>
</tr>

</table>
    <input class="submit" type="submit" name="insert" value="Insert">
</form>

<form method="post" action="user.php">
    <input class="logout" type="submit" name="logout" value="Go Back">
</form>
