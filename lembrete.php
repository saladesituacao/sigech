<?php


if (isset($_POST['note'])) {
  $note = $_POST['note'];
};
if (isset($_POST['color'])) {
  $color = $_POST['color'];
};
if (isset($_REQUEST['delete'])) {
  $delete = $_REQUEST['delete'];
};


if (isset($note)) {
  $sql = "INSERT INTO sigech.tb_lembrete (txt_lembrete, txt_cor) VALUES ('$note', '$color')";
  $acesso->exec($sql);
}

if (isset($delete)) {

  $sql = "DELETE FROM sigech.tb_lembrete WHERE cod_lembrete = '$delete'";
  $acesso->exec($sql);

  redirecionar($url);

}


?>

<div id="containment-wrapper" style="position: absolute; width: 100%; left: 0px; right: 0px; height: 100%;">
  <?php

  $sql = "SELECT * FROM sigech.tb_lembrete WHERE ind_habilitado = 'S'";

  $q1 = pg_query($sql);

  while ($rs1 = pg_fetch_array($q1)) {

    $id = $rs1['cod_lembrete'];
    $message = $rs1['txt_lembrete'];
    $left = $rs1['txt_esquerda'];
    $top = $rs1['txt_acima'];
    $color = $rs1['txt_cor'];

    ?>
	
  <div id="draggable-<?php echo $id; ?>" class="draggable " onchange="javascript:position(this)" style="position:absolute; left: <?php echo $left; ?>px; top: <?php echo $top; ?>px">
	<img class="pin" src="/sigech/assets/img/pin.png" alt="pin" />
	
    <blockquote class="quote-box note-<?php echo $color; ?>">
  
      <p class="quote-text" id="content-<?php echo $id; ?>">
        <?php echo $message; ?>
      </p>
      <hr>
      <div class="blog-post-actions">
        <p>
         
         <div class="popover-markup blog-post-bottom" > 
   
    
    </div>

        <p class="blog-post-bottom pull-right">
        <a class="delete" href="?delete=<?php echo $id; ?>" style="float:right">   <button class="btn btn-danger"  title="delete"><span class="glyphicon glyphicon-trash"></span></button> </a>
        </p>
      </div>
    </blockquote>

  </div>	
		
<?php 
} ?>

</div>
	 
 <script>
 
  jQuery(function() {
	 <?php

  $sql = "SELECT * FROM sigech.tb_lembrete WHERE ind_habilitado = 'S'";


  $q1 = pg_query($sql);

  while ($rs1 = pg_fetch_array($q1)) {

    $id = $rs1['cod_lembrete'];

    ?>
		
    jQuery( "#draggable-<?php echo $id; ?>" ).draggable({ containment: "#containment-wrapper", scroll: false , 

    // Find position where image is dropped.
    stop: function(event, ui) {

    	// Show dropped position.
    	var Stoppos = $(this).position();
		model = {
			id: <?php echo $id; ?>,
            left: Stoppos.left,
			top: Stoppos.top
             };
		 
			 $.ajax({
			  url: "/sigech/classes/salvar_lembrete.php",
			  type: "post",
			  data: model,
			  success: function(data){
				 
jQuery.HP({
	title: "Success!",
      message: "Saved..."
    });
			  },
			  error:function(){
				  alert('error is saving');
			  }   
			}); 
		
		
		
    }
	});
		
	<?php

}
?>
	
  });



$('body').attr("style", "background: url('')");

  </script>

  <br/> <br/> 
  
  
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="index.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><img src="/sigech/assets/img/logo_sigech.png" Width ='60%'  Height='10%' ></center>
      </div>
      <div class="modal-body">
       <div style="width:94%;padding:10px; text-align:center;">


<h3> Escreva o lembrete </h3>
<textarea name="note" style="width:100%; max-width:100%; height:150px; max-height:150px;"></textarea>
<br/>
<b> Escolha uma cor </b>
<br/>
<table style="width:100%;text-align: center;">
<tr>
<td> <input type="radio" name="color" value="1" checked /> </td>
<td> <input type="radio" name="color" value="2" />  </td>
<td> <input type="radio" name="color" value="3" />  </td>
</tr>

<tr>
<td> <div style="width:100px;  height: 100px; background:#FDFB8C; border: 1px solid #DEDC65; margin: 0 auto;width: 100px;">  </div> </td>
<td> <div style="width:100px;  height: 100px; background:#A5F88B; border: 1px solid #98E775; margin: 0 auto;width: 100px;"> </div> </td>
<td> <div style="width:100px;  height: 100px; background:#A6E3FC; border: 1px solid #75C5E7;margin: 0 auto;width: 100px;"> </div> </td>
</tr>

</table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
    <input type="submit" class="btn btn-primary" value="Salvar" />
    
      </div></form>
    </div>

  </div>
</div>
  
  


 