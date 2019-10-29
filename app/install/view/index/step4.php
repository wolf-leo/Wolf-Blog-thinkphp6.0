<div class="wrap">
	<div class="header">
		<h1 class="logo">{$powered}</h1>
		<div class="icon_install">安装向导</div>
		<div class="version">{:$version}</div>
	</div>
	<p class="sql-war">安装过程中请勿刷新页面，等待安装完成提示</p>
	<section class="section">
		<div class="step">
			<ul>
				<li class="on"><em>1</em>检测环境</li>
				<li class="on"><em>2</em>创建数据</li>
				<li class="current"><em>3</em>完成安装</li>
			</ul>
		</div>
		<div class="install" id="log">
			<ul id="loginner">
			</ul>
		</div>
		<div class="bottom tac">
			<a href="javascript:;" class="btn_old">
				<img src="/src/install/i/loading.gif" align="absmiddle" />&nbsp;正在安装...
			</a>
		</div>
	</section>
	<script src="/src/install/j/jquery.js"></script>
	<script>

			window.onbeforeunload = function (e) {
				e = e || window.event;
				if (e) {
					alert(123);
				}

			};

			var n = 0;
			$(function () {
				loadinstallDb(n);
			});
			var data = <?php echo json_encode($post); ?>;
			$.ajaxSetup({cache: false});
			function loadinstallDb(n) {
				var url = "{:url('/index/installDb')}?n=" + n;
				$.ajax({
					type: "POST",
					url: url,
					data: data,
					dataType: 'json',
					success: function (msg) {
						if (msg.n == '999999') {
							$('#dosubmit').attr("disabled", false);
							$('#dosubmit').removeAttr("disabled");
							$('#dosubmit').removeClass("nonext");
							setTimeout('gonext()', 2000);
						} else {
							if (msg.n) {
								$('#loginner').append(msg.msg);
								loadinstallDb(msg.n);
							} else {
								//alert('指定的数据库不存在，系统也无法创建，请先通过其他方式建立好数据库！');
								$('#loginner').append(msg.msg);
							}
						}
					}
				});
			}
			function gonext() {
				window.location.href = "{:url('/index/step5')}";
			}
	</script>
</div>