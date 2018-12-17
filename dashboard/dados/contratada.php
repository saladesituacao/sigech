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


cod_servico_contratada,
cod_estabelecimento,
txt_objeto_contratacao,
nr_contrato,
TO_CHAR(dt_vigencia, 'DD/MM/YYYY') as dt_vigencia,
nr_processo,
cod_usuario,
dt_atualizacao,
ind_habilitado

from sigech.tb_servico_contratada sc
where sc.ind_habilitado = 'S'
and sc.cod_estabelecimento = " . tratarStr($cod );

$rsServicoContratado = $acesso->getRs($sqlServContratado);	

 
?>
