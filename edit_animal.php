<?php
include_once( 'is_valid_access.php' );
include_once( 'sqlite.php' );
include_once( 'error.php' );
include_once( 'header.php' );

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
    <td>Name of the animal <br> <small> Optional</small> </td>
    <td> 
        <input type="text" name="animal_name" 
            placeholder="<?php echo $animal['name']; ?>" > </td>
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
    <td>Cage</td>
    <td> <?php echo cageIdsToHtml( NULL ); ?> </td>
</tr>
<tr>
    <td>Transgenic</td> 
    <td> 
        <input type="radio" name="is_transgenic" value="true"  >True</input>
        <input type="radio" name="is_transgenic" value="false" checked >False</input>
    </td>
</tr>
<tr>
    <td>Genotype Image</td>
    <td>
        <input type="file" name="genotype_image" >
    </td>
</tr>
<tr>
    <td>Comment </td>
    <td> 
        <textarea  rows="3" cols="40" name="cage_comment" form_id="form_insert_animal"> 
        </textarea>
    </td>
</tr>

</table>
<input class="submit" type="submit" name="insert" value="Insert">
</form>

<form action="user.php">
<input class="logout" type="submit" name="goback" value="Go Back">
</form>

</table>

