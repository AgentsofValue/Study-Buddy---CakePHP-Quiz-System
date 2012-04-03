<style>
	thead#report-head th {
		background: #615D57;
		color: #fff;
		padding: 5px;
		text-align: center;
		vertical-align: middle;
	}
	
	tbody#report-body td {
		padding: 5px 2px;
		vertical-align: middle;
	}
	
	.filter-box { float:left; padding: 5px 0; }
	#prev, #next, #pprev, #pnext, #aprev, #anext, #tprev, #tnext, #eprev, #enext, #lprev, #lnext, #rprev, #rnext {
		display: inline-block;
		background-color: #f5f5f5;
		border: 1px solid #dedede;
		border-top: 1px solid #eee;
		border-left: 1px solid #eee;
		font-size: 12px;
		text-decoration: none;
		font-weight: bold;
		color: #565656;
		cursor: pointer;
		padding: 0 10px 0 10px;
		line-height: 20px; /* Safari */
	}

	#prev:hover, #next:hover, #pprev:hover, #pnext:hover,#aprev:hover, #anext:hover, #tprev:hover, #tnext:hover, #eprev:hover, #enext:hover, #lprev:hover, #lnext:hover, #rprev:hover, #rnext:hover {
		background-color: #B7BFBA;
		border: 1px solid #615D57;
		color: #336699;	
	}

	#prev img, #next img, #pprev img, #pnext img, #aprev img, #anext img, #tprev img, #tnext img, #eprev img, #enext img, #lprev img, #lnext img, #rprev img, #rnext img {
		background: none;
		margin: 0 3px -3px 0 !important;
		padding: 0;
		border: none;
		width: 16px;
		height: 16px;
	}
</style>
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