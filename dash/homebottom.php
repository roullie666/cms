<?php include '../lib/common.php';?>
<?php 
	$App->redirecIfNotLogged();
	$App->Part->set();
	$info = $App->Part->get();
?>
<?php include 'parts/header.php';?>
		<div class="container-fluid">
		  <div class="row">
			<div class="col-sm-3 col-lg-2">
				<?php include 'parts/nav.php';?>				
			</div>
			<div class="col-sm-9 col-lg-10">
				
				<div class="">
					<form>
						<h2 class="header-title">HomePage Q&A HTML Markup</h2>
						<label>
							<input type="checkbox" id="show_homepage_bottom" <?=$App->user['show_homepage_bottom']?"checked":""?>/> Show on homepage
						</label>
						<input type="hidden" name="id" value="<?=$info['id']?>" />
						<textarea class="tinymce-area" name="homepage_bottom"><?=$info['homepage_bottom']?></textarea>
						<div class="text-center" style="padding:20px;">
							<button class="btn btn-primary btnSavePrt" style="width:180px;">Save</button>
						</div>
					</form>
				</div>
				
			</div>
		  </div>
		</div>
<?php include 'parts/footer.php';?>
<script type="text/javascript">
	$('.btnSavePrt').click(function(e){
		e.preventDefault();
		
		var ito = $(this);
		
		$.ajax({
			url: 'request/index.php',
			type: 'post',
			dataType: 'json',
			data: {
				action: 'savePart',
				Part: {
					homepage_bottom: tinymce.get('homepage_bottom').getContent(),
					id: $('input[name="id"]').val()
				}
			},
			success: function(ret){
				if( ret.status == 1 ){
					alert("Successfully Updated.");
				}
			},
			error: function(){
				
			}
		});
		
	});
	$('#show_homepage_bottom').on('change',function(){
		var ito = $(this);
		
		$.ajax({
			url : 'request/index.php',
			type : 'post',
			dataType: 'json',
			data: {
				action: 'show_homepage_bottom',
				show_homepage_bottom : (ito.is(':checked') ? 1 : 0)
			},
			success: function(){
				
			}
		});
		
	});
</script>