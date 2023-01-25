<!--------------------------------------------------- INICIO DO FOOTER ------------------------------------------>

<!-- <script src="js/dataTables.bootstrap5.min.js"></script> -->

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script><!----- FUNCTIONS ------>
<script type="text/javascript" src="js/api_cep.js"></script><!----- AP CEP - online ------>
<script type="text/javascript" src="js/bootstrap.min.js"></script><!----- BOOSTRAP MIN ------>
<script type="text/javascript" src="js/jquery.mask.min.js"></script><!-- JQUERY - MASK ------>
<script type="text/javascript" src="js/pdfmake.min.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/jszip.min.js"></script>
<script type="text/javascript" src="js/buttons.html5.min.js"></script>


<!----- MASK  ------>
<script type="text/javascript">
$(document).ready(function() {
    $("#cpf").mask("000.000.000-00")
    $("#cep").mask("00.000-000")
    $('#ano_car').mask("0000")

    $("#telefone").mask("(00) 0000-00009")
    $("#telefone").blur(function(event) {
        if ($(this).val().length == 15) {
            $("#telefone").mask("(00) 00000-0009")
        } else {
            $("#telefone").mask("(00) 0000-00009")
        }
    })
})
</script>

<!--------------------------------------------------- INICIO DO MENU ------------------------------------------>