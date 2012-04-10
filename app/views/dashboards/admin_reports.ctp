<div style=" font-size: 13px; margin-top: 50px">
	<div id="quiz-reports"></div>
</div>
<script type="text/javascript">
	$(function(){	
		var content = $("#quiz-reports");
		var xurl = "<?php  echo $html->url('/dashboards/reports_result'); ?>";
		
		$.ajax({
			url: xurl,
			beforeSend: function() {
				content.html('<?php echo $html->image('ajax-loader.gif'); ?>');
			},
			success: 
				function(msg) {
					content.html(msg); 
				}
		});
	});
	
	function getUrl(content, url) {
		var container = $("#quiz-reports");
		var ajaxLoad = $("#load-reports");
		
		$.ajax({
			url: url,
			beforeSend: function() {
				ajaxLoad.html('<?php echo $html->image('ajax-loader.gif'); ?>'); 
			},
			success: function(msg){
				ajaxLoad.html('<?php echo $html->image('ajax-loader.gif'); ?>').remove();
				container.html(msg);
			}
		});
	}
</script>