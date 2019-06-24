<?php 
if ($_GET['cod'] != ''){
    $cod = $_GET['cod'];

}else if ($_POST['cod_estabelecimento'] != ''){

    $cod = $_POST['cod_estabelecimento'];
}
else{
    alert('Estabelecimento não encontrado!');
}
 

$sqlEstab = "SELECT nm_estabelecimento FROM sigech.tb_estabelecimento WHERE cod_estabelecimento = " . tratarStr($cod );

$rsEstab = $acesso->getRs($sqlEstab);
$linhaEstab = pg_fetch_row($rsEstab);

if ($linhaEstab){
    $estabelecimento = $linhaEstab[0];
}else{
    alert('Estabelecimento não encontrado!');
    //voltar();
}

//Retornar os dados dos serviços Habilitados
$sqlEstabServHabilitado = "select 
she.cod_servico_habilitado_estabelecimento, ab.nr_area_habilitacao, she.cod_servico, s.nr_servico, s.nm_servico, she.cod_estabelecimento, e.nm_estabelecimento,
 
she.vl_valor, she.ds_portaria, she.nr_leitos, she.ds_observacao, she.txt_url_portaria
from sigech.tb_servico_habilitado_estabelecimento she
inner join sigech.tb_servico s
on she.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on she.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where she.ind_habilitado = 'S'
and e.cod_estabelecimento = " . tratarStr($cod );




$rsEstabServHabilitado = $acesso->getRs($sqlEstabServHabilitado);	

 
//Retornar os dados dos serviços com potencial de habilitação
$sqlEstabServPotHabilitacao = "select 
sphe.cod_servico_potencial_habilitacao_estabelecimento, ab.nr_area_habilitacao, sphe.cod_servico, s.nr_servico, s.nm_servico, sphe.cod_estabelecimento, e.nm_estabelecimento,
sphe.vl_valor, sphe.ds_portaria, sphe.nr_leitos, sphe.ds_observacao, sphe.ds_nr_processo,
sphe.ds_meio_processo,
sphe.ds_localizacao_processo,
sphe.txt_url_portaria,
sphe.txt_nr_processo_sei
from sigech.tb_servico_potencial_habilitacao_estabelecimento sphe
inner join sigech.tb_servico s
on sphe.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on sphe.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where e.cod_estabelecimento =  " . tratarStr($cod );

$rsEstabServPotHabilitacao = $acesso->getRs($sqlEstabServPotHabilitacao);	


 

//Retornar os dados dos serviços Desabilitados
$sqlEstabServDesHabilitado = "select 
she.cod_servico_habilitado_estabelecimento, ab.nr_area_habilitacao, she.cod_servico, 
s.nr_servico, s.nm_servico, she.cod_estabelecimento, e.nm_estabelecimento,

she.vl_valor, she.ds_portaria, she.nr_leitos, she.ds_observacao, she.ds_justificativa_desabilitacao


from sigech.tb_servico_habilitado_estabelecimento she
inner join sigech.tb_servico s
on she.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on she.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where she.ind_habilitado = 'N' and e.cod_estabelecimento = " . tratarStr($cod );



$rsEstabServDesHabilitado = $acesso->getRs($sqlEstabServDesHabilitado);	


//Lista do plano de credenciamento e habilitação
$sqlPCH = "select pch.cod_pch_estabelecimento, pch.cod_estabelecimento, pch.cod_local_vistoria, lv.txt_local_vistoria, 
TO_CHAR(pch.dt_cadastro, 'DD/MM/YYYY') as dt_cadastro, pch.nr_item, pch.txt_nao_conformidade, pch.txt_determinacao,
pch.nr_dias_prazo_determinacao, pch.txt_responsavel, pch.nr_dias_prazo_responsavel,
TO_CHAR(pch.dt_cumprimento, 'DD/MM/YYYY') as dt_cumprimento, pch.txt_observacao, current_date - pch.dt_cadastro as diascorridos

from sigech.tb_pch_estabelecimento as pch
inner join sigech.tb_estabelecimento est
    on pch.cod_estabelecimento = est.cod_estabelecimento
inner join sigech.tb_local_vistoria lv
    on pch.cod_local_vistoria = lv.cod_local_vistoria
where pch.dt_cumprimento IS NULL AND est.cod_estabelecimento = " . tratarStr($cod ) . " order by txt_local_vistoria asc, nr_item ASC "

;
  
//echo $sqlPCH;


  $rsPCH = $acesso->getRs($sqlPCH);	
 



//Lista do plano de credenciamento e habilitação (Não conformidades concluídas pelas unidades)
$sqlPCHC = "select pch.cod_pch_estabelecimento, pch.cod_estabelecimento, pch.cod_local_vistoria, lv.txt_local_vistoria, 
TO_CHAR(pch.dt_cadastro, 'DD/MM/YYYY HH:MM:SS') as dt_cadastro, pch.nr_item, pch.txt_nao_conformidade, pch.txt_determinacao,
pch.nr_dias_prazo_determinacao, pch.txt_responsavel, pch.nr_dias_prazo_responsavel,
TO_CHAR(pch.dt_cumprimento, 'DD/MM/YYYY HH:MM:SS') as dt_cumprimento, pch.txt_observacao, current_date - pch.dt_cadastro as diascorridos,
u.txt_nome as usuario

from sigech.tb_pch_estabelecimento as pch
inner join sigech.tb_estabelecimento est
    on pch.cod_estabelecimento = est.cod_estabelecimento
inner join sigech.tb_local_vistoria lv
    on pch.cod_local_vistoria = lv.cod_local_vistoria
LEFT JOIN sigech.tb_usuario u ON pch.cod_usuario = u.cod_usuario
where pch.dt_cumprimento IS NOT NULL AND pch.ind_habilitado = 'S' AND est.cod_estabelecimento = " . tratarStr($cod ) . " order by txt_local_vistoria asc, nr_item ASC "

;
  
//echo $sqlPCHC;


  $rsPCHC = $acesso->getRs($sqlPCHC);	
 




//historico de modificações no item do plano de credenciamento e habilitação

$sqlHPCH = "select hpch.cod_pch_estabelecimento,
hpch.cod_estabelecimento,
hpch.cod_local_vistoria,
lv.txt_local_vistoria,
TO_CHAR(
   hpch.dt_cadastro,
   'DD/MM/YYYY'
) AS dt_cadastro,
hpch.nr_item,
hpch.txt_nao_conformidade,
hpch.txt_determinacao,
hpch.nr_dias_prazo_determinacao,
hpch.txt_responsavel,
hpch.nr_dias_prazo_responsavel,
TO_CHAR(
   hpch.dt_cumprimento,
   'DD/MM/YYYY'
) AS dt_cumprimento,
hpch.txt_observacao,
CURRENT_DATE - hpch.dt_cadastro AS diascorridos,
   TO_CHAR(
   hpch.dt_atualizacao,
   'DD/MM/YYYY HH:MM:SS'
) AS dt_atualizacao,
u.txt_nome as usuario
FROM
   sigech.tb_historico_pch_estabelecimento AS hpch
INNER JOIN sigech.tb_pch_estabelecimento AS pch ON hpch.cod_pch_estabelecimento = pch.cod_pch_estabelecimento
INNER JOIN sigech.tb_estabelecimento est ON pch.cod_estabelecimento = est.cod_estabelecimento
INNER JOIN sigech.tb_local_vistoria lv ON pch.cod_local_vistoria = lv.cod_local_vistoria
INNER JOIN sigech.tb_usuario u ON hpch.cod_usuario = u.cod_usuario
WHERE
   hpch.cod_pch_estabelecimento = " . tratarStr($_POST['cod_pch_estabelecimento']) . "
ORDER BY
   dt_atualizacao DESC ";


   $rsHPCH = $acesso->getRs($sqlHPCH);	

?>
