<?php 

include_once( "is_valid_access.php" );
include_once( "methods.php" );

// List of taks a user can do.
?>

 <table id="table_input">
  <tr>
    <td>Insert a new cage</td>
    <td> 
        <form method="post" action="insert_cage.php">
            <input type="submit" name="response" value="Insert Cage" >
        </form>
    </td>
  </tr>
   <tr>
    <td>Insert a new animal</td>
    <td> 
        <form method="post" action="insert_animal.php">
            <input type="submit" name="response" value="Insert Animal" >
        </form>
    </td>
  </tr>
</table>
<br />

<form method="post" action="user_show_animal_info.php" id="form_show_animnal">
<table id="table_input">
  <tr>
    <td valign="top">
            <?php $animals = getAnimalList( ); 
                echo animalsToDataList( $animals );
            ?> Animal 
            <input list="animal_list" name="animal_id" required >
    </td>
    <td>
        <input type="submit"  name="response" value="Show current status" >
        <br>
        <input type="submit"  name="response" value="Show hisotry" >
    </td>
  </tr>
</table> 
</form>

<br />

<form method="post" action="edit_animal.php" id="form_edit_animnal">
<table id="table_input">
  <tr>
    <td valign="top">
            <?php $animals = getAnimalList( ); 
                echo animalsToDataList( $animals );
            ?> Animal 
            <input list="animal_list" name="animal_id" required >
    </td>
    <td>
        <input type="submit"  name="response" value="Assign/Change cage" >
        <br>
        <input type="submit"  name="response" value="Update health" >
        <br>
        <input type="submit"  name="response" value="Record genotype" >
    </td>
    
  </tr>
</table> 
</form>

<form method="post" action="index.php">
<input class="logout" type="submit" name="submit" value="Log Out">
<?php unset($_SESSION); ?>
</form>
