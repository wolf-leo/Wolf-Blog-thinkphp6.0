<link rel="stylesheet" href="/src/admin/wangEditor/css/wangEditor.min.css">
<script type="text/javascript" src="/src/admin/wangEditor/js/wangEditor.min.js"></script>
<div class="aright">
	<fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
		<legend><?php echo isset($info['id']) ? '修改' : '添加'; ?>文章</legend>
	</fieldset>
	<form class="layui-form bform" method="post" enctype="multipart/form-data">
		<div class="layui-form-item">
			<label class="layui-form-label">文章标题</label>
			<div class="layui-input-block">
				<input type="text" name="title" required lay-verify="required" value="{$info.title}" placeholder="必填内容" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">缩略图</label>
			<div class="layui-input-block">
				<div class="file-box">
					<i class="layui-icon">&#xe61f;</i>
					<input class="file-btn" type="button" value="选择图片"> 
					<input class="file-txt" type="text" autocomplete="off"  id="textfield">
					{if ($info['img'])}<img src="{$info.img|default=''}" width="120">{else /}{/if}
					<input class="file-file" type="file" name="img" id="pic" size="28" onchange="document.getElementById('textfield').value = this.value" /> 
				</div>
			</div>
		</div>
		<div class="layui-form-item" style="width: 300px;">
			<label class="layui-form-label">文章类型</label>
			<div class="layui-input-block">
				<select name="type">
					<option value="0">请选择</option>
					{foreach $type as $key=>$vo} 
					<option {if ($info['type']==$key)}selected="selected"{/if} value="{$key}">{$vo}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="layui-form-item" style="width: 300px;">
			<label class="layui-form-label">文章状态</label>
			<div class="layui-input-block">
				<select name="status">
					<option value="0">请选择</option>
					{foreach $notes['status'] as $key=>$vo} 
					<option {if ($info['status']==$key)}selected="selected"{/if} value="{$key}">{$vo}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章内容</label>
			<div class="layui-input-block">
				<div id="textarea" style='width:70%;height:550px;'>
					<p>{$info.content|raw}</p>
				</div>
				<textarea id="text1" style="display: none;" name="content"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="hidden" name="id" value="{$info.id}">
				<button class="layui-btn" lay-filter="formDemo" >立即提交</button> 
			</div>
		</div>
	</form>
</div>

<script>
		layui.use('form', function () {
			var form = layui.form();
		});
		var E = window.wangEditor;
		var editor = new E('#textarea');
		var $text1 = $('#text1');
		editor.customConfig.uploadImgServer = "{:url('Article/UploadPic')}";
		editor.customConfig.uploadFileName = 'info_upload_img';
		editor.customConfig.onchange = function (html) {
			$text1.val(html);
		};
		editor.create();
		$text1.val(editor.txt.html());
		$('#textarea .w-e-text,.w-e-text-container').attr('style', 'border: 1px solid #ccc;width:100%;height:500px;');
</script>