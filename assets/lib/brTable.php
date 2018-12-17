<?php
/**
 * Carrega os arquivos javascript necessarios para incluir a barra de botoes adicionais nas tabelas
 */
echo"
	<!-- Funcionalidades extras para a tabela -->
	<link href='/sigech/assets/css/bootstrap-table.min.css' rel='stylesheet' type='text/css' >
	<script type='text/javascript' src='/sigech/assets/js/bootstrap-table.min.js'></script>
	<script type='text/javascript' src='/sigech/assets/js/bootstrap-table-filter-control.min.js'></script>
	<script type='text/javascript' src='/sigech/assets/js/bootstrap-table-pt-BR.js'></script>
	<!-- Para as opcoes de exportacao -->
	<script type='text/javascript' src='/sigech/assets/js/tableExport.js'></script>
	<script type='text/javascript' src='/sigech/assets/js/jquery.base64.js'></script>
	<script type='text/javascript' src='/sigech/assets/js/bootstrap-table-export.min.js'></script>
";
//corrige os estilos
echo "
<style>
.fixed-table-container tbody td .th-inner, .fixed-table-container thead th .th-inner {
    white-space: normal;
    font-size: 14px;
    line-height: 14px;
}
.filterControl select {
    height: 24px;
	padding: 0 12px;
}
.filterControl input {
    height: 24px;
	padding: 0 12px;
}
.fixed-table-toolbar{
	height:30px;
}
.fixed-table-toolbar button {
	height:100%;
}
</style>
"
?>
