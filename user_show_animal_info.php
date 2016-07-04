<?php

include 'tables.php';
echo animalToHTMLTable( $_POST['animal_id'] );

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


<!-- This solution is not working.
<button id="cmd">generate PDF</button>
-->

<div style="float: right">
    <?php echo goBackToPageLink( "user.php" ); ?>
</div>

