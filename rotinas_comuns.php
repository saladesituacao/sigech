<?php

	function decodeTxt($param){
		return $param;
	}

	function encodeTxt($param){

		return utf8_encode($param);
	}

	function inteiro($param){
        if ($param == ''){
           return (int)0;
        }else{
           return (int)$param;
        }
    }

	function tratarStr($param){

		if ($param == ''){
			return "NULL";
		}

		return "'$param'";
	}


	function retornarNumeros($param){
		$ret = "";
		for ($i=0; $i<strlen($param); $i++){
			$letra = substr($param,$i, 1);

			if (is_numeric($letra)){
				$ret .= $letra;
			}
		}
		return $ret;
	}

	function mask($param, $mascara){

		if ($param == "")
			return "";

		$ret = "";
		for ($i=0; $i<strlen($mascara); $i++){
			$letraM = substr($mascara,$i, 1);

			if ($letraM == "#"){
				// pegar primeiro digito
				$ret .= substr($param,0, 1);
				//retirar primeiro digito
				$param = substr($param,1);

			}else{
				$ret .= $letraM;
			}
		}

		return $ret;
	}


	function tratarData($data){

		if ($data == ''){
			return "NULL";
		}

		if (strLen($data) <> 10){
			return $data;
		}

		$dia = substr($data,0,2);
		$mes = substr($data,3,2);
		$ano = substr($data,6);

		return "'" . $ano . "/" . $mes . "/" . $dia . "'";
	}

	function tratarDataSemAspas($data){

		if ($data == ''){
			return "NULL";
		}

		if (strLen($data) <> 10){
			return $data;
		}

		$dia = substr($data,0,2);
		$mes = substr($data,3,2);
		$ano = substr($data,6);

		return $ano . "/" . $mes . "/" . $dia ;
	}

	function formatarDataBrasil($data){

		if (strLen($data) <> 10){
			return $data;
		}

		$ano = substr($data,0,4);
		$mes = substr($data,5,2);
		$dia = substr($data,8,2);

		return $dia . "/" . $mes . "/" . $ano;
	}

	function dataAtual(){
		return "NOW()";
	}

	function alert($msg){
		echo "<script>alert('".  $msg . "');</script>";
	}

	function voltar(){
		echo "<script>history.go(-1);</script>";
		exit();
	}

	function voltar2(){
		echo "<script>history.go(-2);</script>";
		exit();
	}

	function redirecionar($url){
		echo "<script>document.location.href='$url';</script>";
		exit();
	}


	function submeter($destino, $nomeCampo, $valorCampo){
		?>
		<html>
		<body>
		<form name='frm' method=post action='<?php echo $destino?>'>
			<?php
			//private $i, $vNome, $vValor;

			$vNome = split(',', $nomeCampo);
			$vValor = split(',', $valorCampo);

			for ($i=0; $i<=count($vNome); $i++){
				?>
				<input type="hidden" name='<?php echo $vNome[$i] ?>' value='<?php echo $vValor[$i]?>'>
				<?php 
			}
			?>
		</form>
		<script language='javascript'>
			frm.submit();
		</script>
		</body>
		</html>
		<?php
		exit();
	}



	function limitarTexto($texto, $limite){
		$contador = strlen($texto);
		if ( $contador >= $limite ) {
			$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
			return $texto;
		}
		else{
		  return $texto;
	   }
	  }


	  function DataBanco($dateSql){
		$ano= substr($dateSql, 6);
		$mes= substr($dateSql, 3,-5);
		$dia= substr($dateSql, 0,-8);
		return $ano."-".$mes."-".$dia;
	}

	
?>
