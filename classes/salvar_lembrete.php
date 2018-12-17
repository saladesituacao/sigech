<?php


include("Acesso.php");


$id = $_POST["id"]; 
if(isset($_POST['text'])) {
$text = $_POST['text'];
}
if(isset($_POST['left'])){
$left = $_POST["left"]; 
}if(isset($_POST["top"]))
$top = $_POST["top"]; 
if(isset($_POST['text'])) {


    global $acesso;

    $sql = "UPDATE sigech.tb_lembrete SET txt_lembrete='$text' WHERE cod_lembrete='$id' ";
    $acesso->exec($sql);
    $sql = "select txt_lembrete from sigech.tb_lembrete WHERE cod_lembrete='$id'";
    $q1 = pg_query($sql);
    $rs1 = pg_fetch_array($q1);
    
$message = '<div class="form-group">
            <textarea id="'.$id.'"  class="quick" onchange="">'.$rs1['txt_lembrete'].'</textarea>
        </div>
       <button data-vendor-id="" data-act="send" onClick="javascript:getText('.$id.')" class="btn btn-info save_notes">Salvar</button>';

 outputJSON($rs1['txt_lembrete'],'success',$message);

}
if($top || $left) {
$sql = "UPDATE sigech.tb_lembrete SET txt_esquerda='$left', txt_acima='$top' WHERE cod_lembrete='$id' ";
$acesso->exec($sql);
}

?>