<div class="wrap">
	<div class="header">
		<h1 class="logo">{$powered}</h1>
		<div class="icon_install">安装向导</div>
		<div class="version">{:$version}</div>
	</div>
	<section class="section">
		<div class="step">
			<ul>
				<li class="current"><em>1</em>检测环境</li>
				<li><em>2</em>创建数据</li>
				<li><em>3</em>完成安装</li>
			</ul>
		</div>
		<div class="server">
			<table width="100%">
				<tr>
					<td class="td1">环境检测</td>
					<td class="td1" width="25%">推荐配置</td>
					<td class="td1" width="25%">当前状态</td>
					<td class="td1" width="25%">最低要求</td>
				</tr>
				<tr>
					<td>操作系统</td>
					<td>Linux</td>
					<td>{:correct_span(PHP_OS,1)}</td>
					<td>不限制</td>
				</tr>
				<tr>
					<td>PHP版本</td>
					<td>>7.1.x</td>
					<td>{$phpversion|raw}</td>
					<td>7.1.0</td>
				</tr>
				<tr>
					<td>Mysql版本</td>
					<td>>5.x.x</td>
					<td>{$mysql|raw}</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>附件上传</td>
					<td>>2M</td>
					<td>{$uploadSize|raw}</td>
					<td>不限制</td>
				</tr>
				<tr>
					<td>session</td>
					<td>开启</td>
					<td>{$session|raw}</td>
					<td>开启</td>
				</tr>
				<tr>
					<td>curl扩展库</td>
					<td>开启</td>
					<td>{$curl|raw}</td>
					<td>开启</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td class="td1">目录、文件权限检查</td>
					<td class="td1" width="25%">写入</td>
					<td class="td1" width="25%">读取</td>
				</tr>
				<?php
				$err = 0;
				foreach ($folder as $dir) {
					$testdir = \think\facade\App::getRootPath() . $dir;
					if (testwrite($testdir)) {
						$w = '<span class="correct_span">&radic;</span>可写 ';
					} else {
						$w = '<span class="correct_span error_span">&radic;</span>不可写 ';
						$err++;
					}
					if (is_readable($testdir)) {
						$r = '<span class="correct_span">&radic;</span>可读';
					} else {
						$r = '<span class="correct_span error_span">&radic;</span>不可读';
						$err++;
					}
					?>
					<tr>
						<td><?php echo $dir; ?></td>
						<td><?php echo $w; ?></td>
						<td><?php echo $r; ?></td>
					</tr>
					<?php
				}
				?>  
			</table>
			<font color="red">当出现【不可写】的提示时，Linux系统下请给当前目录相应的写入权限，如777</font>
			<br />
			<br />
		</div>
		<div class="bottom tac"> <a href="javascript:;" onclick=" window.location.reload()" class="btn">重新检测</a>
			<?php if (!$err) { ?><a href="{:url('/index/step3')}" class="btn">下一步</a><?php } ?>
		</div>
	</section>
</div>