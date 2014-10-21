<script type="text/javascript">
$(function() {
	$("#menu_ppl").sortable({
		update : function () {
			serial = $("#menu_ppl").sortable('serialize');
			$.ajax({
				url: "modulos/menu_ppl.php?action=ordenar",
				type: "POST",
				data: serial
			});
		}
	});
	$("#menu_ppl").disableSelection();
});
</script>
<div class="cuerpo" id="menu_ppl">
  <!-- START BLOCK : modulo -->
  <div class="categorias" style="background-image: url(images/iconos/{img_mod});" id="mod_{id_mod}">
    <div onclick="document.location.href='?mod={url_mod}'"></div>
    <span onclick="document.location.href='?mod={url_mod}'">{nom_mod}</span>
  </div>
  <!-- END BLOCK : modulo -->
</div>