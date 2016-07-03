<?php

include 'is_valid_access.php';

$animal = getAnimalWithId( $_POST['animal_id'] );

var_dump( $animal );

?>

<!-- Here goes the html table of animal -->

<!-- This solution is not working.
<script type="text/javascript" charset="utf-8">
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('animal.pdf');
    });
</script>
-->

<table border="0" class="info" id="table_animal_info_basic">
    <tr>
        <td>Animal Id</td> 
        <td> <?php echo $animal['id']; ?> </td>
    </tr>
    <tr>
        <td >Name</td> 
        <td> <?php echo $animal['name']; ?> </td>
    </tr>
    <tr>
        <td >Gender</td> 
        <td> <?php echo $animal['gender']; ?> </td>
    </tr>
    <tr>
        <td>Strain</td> 
        <td> <?php echo $animal['strain']; ?> </td>
    </tr>
    <tr>
        <td >Current cage ID</td> 
        <td> <?php echo $animal['current_cage_id']; ?> </td>
    </tr>
    <tr>
        <td>Date of birth</td>
        <td> <?php echo $animal['dob']; ?> </td> 
    </tr>
    <tr>
        <td>Age</td>
        <td> <?php echo ageInDays( $animal['dob'] ); ?> 
            ( <?php echo $animal['status']; ?> )
        </td>
    </tr>
    <tr>
        <td>Born in cage with ID</td>
        <td> <?php echo $animal['parent_cage_id'] ?> </td>
    </tr>
</table>
<br />
<table border="0" class="info" id="table_animal_info_genotype">
    <tr>
        <td>Is transgenic</td> 
        <td> <?php echo $animal['is_transgenic']; ?> </td>
    </tr>
    <tr>
        <td>Genotype done on</td> 
        <td> <?php echo $animal['genotype_done_on']; ?> </td>
    </tr>
    <tr>
        <td>Genotype done by</td> 
        <td> <?php echo $animal['genotype_done_by']; ?> </td>
    </tr>
</table>

<br />
<table border="0" class="info" id="table_animal_info_health">
    <tr>
        <td>Weight</td> 
        <td> <?php echo $animal['weight']; ?> gm </td>
    </tr>
    <tr>
        <td>Length</td>
        <td> <?php echo $animal['length']; ?> mm</td>
    </tr>
    <tr>
        <td>Height</td>
        <td> <?php echo $animal['height']; ?> mm</td>
    </tr>
    <tr>
        <td>Condition</td>
        <td> <?php echo $animal['condition']; ?></td>
    </tr>
<?php
    if( $animal['status'] == "alive" )
    {
        echo '<tr><td><font color="blue">Died on</strong></td>';
        echo '<td>' . $animal['died_on'] . '</td>';
        echo '</tr>';
        echo '<tr><td>Deadly reason</td>';
        echo '<td>' . $animal['deadly_reason'] . '</td>';
        echo '</tr>';
    }
?>
</table>
<br />
<table border="0" class="info" id="table_animal_info_log">
    <tr> TODO: Write log </tr>
</table>

<!-- This solution is not working.
<button id="cmd">generate PDF</button>
-->

<div style="float: right">
    <?php echo goBackToPageLink( "user.php" ); ?>
</div>

