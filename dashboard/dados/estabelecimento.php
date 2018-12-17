<?php 

//Query para  retornar os estabelecimentos classificados como hospitais
$sqlHospital = "SELECT DISTINCT estab.cod_estabelecimento, estab.nm_estabelecimento, estab.cod_classificacao_estabelecimento
FROM sigech.tb_estabelecimento estab 
WHERE estab.cod_classificacao_estabelecimento = 1 ";

$rsHospital = $acesso->getRs($sqlHospital);	


//Query para  retornar os estabelecimentos classificados como Unidades de saúde / média complexidade
$sqlUnidSaude = "SELECT DISTINCT estab.cod_estabelecimento, estab.nm_estabelecimento, estab.cod_classificacao_estabelecimento
FROM sigech.tb_estabelecimento estab 
WHERE estab.cod_classificacao_estabelecimento = 2 ";


$rsUnidSaude = $acesso->getRs($sqlUnidSaude);	

//Query para  retornar os estabelecimentos classificados como contratadas
$sqlContratada = "SELECT DISTINCT estab.cod_estabelecimento, estab.nm_estabelecimento, estab.cod_classificacao_estabelecimento
FROM sigech.tb_estabelecimento estab 
WHERE estab.cod_classificacao_estabelecimento = 3 ";


$rsContratada = $acesso->getRs($sqlContratada);	

?>
