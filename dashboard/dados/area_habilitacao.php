<?php 

//Query para  retornar áreas para habilitação
$sqlAreaHabilitacao = "SELECT cod_area_habilitacao, nr_area_habilitacao, nm_area_habilitacao
FROM sigech.tb_area_habilitacao 
";


$q_AreaHabilitacao=pg_query($sqlAreaHabilitacao) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');

?>
