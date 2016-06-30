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
  <tr>
    <td>Edit/Update Animal</td>
    <td>
        <form method="post" action="edit_animal.php">
            <?php $animals = getAnimalList( ); 
                echo animalListToHtml( $animals );
            ?>
            <input type="submit" name="response" value="Edit" >
        </form>
    </td>
  </tr>
</table> 

<form method="post" action="index.php">
<input class="logout" type="submit" name="submit" value="Log Out">
<?php unset($_SESSION); ?>
</form>
