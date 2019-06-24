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

//Retornar os dados dos serviços contratados
$sqlServContratado = "select 

sc.cod_servico_contratada,
sc.cod_estabelecimento,
sc.txt_objeto_contratacao,
sc.nr_contrato,
TO_CHAR(sc.dt_vigencia, 'DD/MM/YYYY') as dt_vigencia,
sc.nr_processo,
sc.cod_usuario,
sc.dt_atualizacao,
sc.ind_habilitado,
ab.nr_area_habilitacao,
s.nr_servico,
s.nm_servico

from sigech.tb_servico_contratada sc
left join sigech.tb_servico s
on sc.cod_servico = s.cod_servico
left join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where sc.ind_habilitado = 'S'
and sc.cod_estabelecimento = " . tratarStr($cod );

$rsServicoContratado = $acesso->getRs($sqlServContratado);	




//Retornar os dados dos serviços Desabilitados das contratadas
$sqlServDesHabilitado = "select 
sc.cod_servico_contratada, ab.nr_area_habilitacao, sc.cod_servico, 
s.nr_servico, s.nm_servico, sc.cod_estabelecimento, e.nm_estabelecimento,

sc.txt_objeto_contratacao, sc.nr_contrato,TO_CHAR(sc.dt_vigencia, 'DD/MM/YYYY') as dt_vigencia,TO_CHAR(sc.dt_desabilitacao, 'DD/MM/YYYY') as dt_desabilitacao

from sigech.tb_servico_contratada sc
inner join sigech.tb_servico s
on sc.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on sc.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where sc.ind_habilitado = 'N' and e.cod_estabelecimento = " . tratarStr($cod );



$rsServDesHabilitado = $acesso->getRs($sqlServDesHabilitado);	


 
?>
