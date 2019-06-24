<?php
include("../classes/Acesso.php");
include("../rotinas_comuns.php");
include("../options/optServico.php");

$servico = new servico();

echo $servico->buscarServico($_GET["cod_area_habilitacao"]);
?>