<?php /*a:2:{s:89:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/new/app/admin/view/admin_user/index.html";i:1605855890;s:90:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/new/app/admin/view/common/_container.html";i:1593828172;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit"/><!-- 让360浏览器默认选择webkit内核 -->

    <!-- 全局css -->
    <!-- 全局css -->
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/css/style.css?v=1.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/js/plugins/layui/css/layui.css?ver=170803"  media="all">
	<link href="/static/css/plugins/webuploader/webuploader.css" rel="stylesheet">
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
	<script src="/static/js/plugins/validate/bootstrapValidator.min.js"></script>
    <script src="/static/js/plugins/validate/zh_CN.js"></script>
    <script src="/static/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/static/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script src="/static/js/plugins/layer/layer.min.js"></script>
    <script src="/static/js/plugins/layer/laydate/laydate.js"></script>
    <script src="/static/js/common/ajax-object.js?v=<?php echo rand(1000,9999)?>"></script>
    <script src="/static/js/common/bootstrap-table-object.js"></script>
    <script src="/static/js/common/Feng.js"></script>
	<script src="/static/js/plugins/webuploader/webuploader.min.js"></script>
	<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" src="/static/js/xheditor/xheditor-1.2.2.min.js"></script>
	<script type="text/javascript" src="/static/js/xheditor/xheditor_lang/zh-cn.js"></script>
	 <script type="text/javascript">
		<?php
			$domains = config('app.domain_bind');
			$app = app('http')->getName();
			if(in_array($app,$domains)){			
				$ctxPathUrl = request()->domain();
			}else{
				$ctxPathUrl = request()->domain().'/'.getKeyByVal(config('app.app_map'),$app);
			}
		?>
        Feng.addCtx("<?php echo $ctxPathUrl;?>");
        Feng.sessionTimeoutRegistry();
    </script>
</head>

<body>
<div class="wrapper wrapper-content animated fadeInRight">
	
<div class="row">
	<div class="col-sm-12">
		<div class="ibox float-e-margins">
			<div class="ibox-content"> 
				<div class="row row-lg"> 
					<div class="col-sm-12"> 
						<div class="row" id="searchGroup">
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">用户名</button>
									</div>
									<input type="text" autocomplete="off" class="form-control" id="user" placeholder="用户名" />
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">所属分组</button>
									</div>
									<select class="form-control" id="role_id">
										<option value="">请选择</option>
										<?php $_result=htmlOutList(\think\facade\Db::query('select role_id,name,pid from role'),false);if($_result)$_result = formartList(explode(",","role_id,pid,name,name"),$_result);foreach($_result as $key=>$sql):?>
										<option value="<?php echo $sql['role_id']; ?>"><?php echo $sql['name']; ?></option>
										<?php endforeach?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">状态</button>
									</div>
									<select class="form-control" id="status">
										<option value="">请选择</option>
										<option value="1">开启</option>
										<option value="0">关闭</option>
									</select>
								</div>
							</div>
							<!-- search end -->
							<div class="col-sm-1">
								<button type="button" class="btn btn-success " onclick="CodeGoods.search()" id="">
									<i class="fa fa-search"></i>&nbsp;搜索
								</button>
							</div>
						</div>
						<div class="btn-group-sm" id="CodeGoodsTableToolbar" role="group">
						<?php if(in_array('admin/AdminUser/add',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="add" class="btn btn-primary button-margin" onclick="CodeGoods.add()">
						<i class="fa fa-plus"></i>&nbsp;添加
						</button>
						<?php endif; if(in_array('admin/AdminUser/update',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="update" class="btn btn-success button-margin" onclick="CodeGoods.update()">
						<i class="fa fa-edit"></i>&nbsp;修改
						</button>
						<?php endif; if(in_array('admin/AdminUser/updatePassword',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="updatePassword" class="btn btn-warning button-margin" onclick="CodeGoods.updatePassword()">
						<i class="fa fa-pencil"></i>&nbsp;修改密码
						</button>
						<?php endif; if(in_array('admin/AdminUser/delete',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="delete" class="btn btn-danger button-margin" onclick="CodeGoods.delete()">
						<i class="fa fa-trash"></i>&nbsp;删除
						</button>
						<?php endif; ?>
						</div>
						<table id="CodeGoodsTable" data-mobile-responsive="true" data-click-to-select="true">
							<thead><tr><th data-field="selectItem" data-checkbox="true"></th></tr></thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var CodeGoods = {id: "CodeGoodsTable",seItem: null,table: null,layerIndex: -1};

	CodeGoods.initColumn = function () {
 		return [
 			{field: 'selectItem', radio: true},
 			{title: '编号', field: 'user_id', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '真实姓名', field: 'name', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '用户名', field: 'user', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '所属分组', field: 'role_name', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '备注', field: 'note', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '状态', field: 'status', visible: true, align: 'center', valign: 'middle',sortable: true,formatter:CodeGoods.statusFormatter},
 			{title: '创建时间', field: 'create_time', visible: true, align: 'center', valign: 'middle',sortable: true,formatter:CodeGoods.create_timeFormatter},
 			{title: '操作', field: '', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.buttonFormatter'},
 		];
 	};

	CodeGoods.buttonFormatter = function(value,row,index) {
		if(row.user_id){
			var str= '';
			<?php if(in_array('admin/AdminUser/update',session('admin.nodes')) || session('admin.role_id') == 1): ?>
			str += '<button type="button" class="btn btn-success btn-xs" title="修改"  onclick="CodeGoods.update('+row.user_id+')"><i class="fa fa-edit"></i>&nbsp;修改</button>&nbsp;';
			<?php endif; if(in_array('admin/AdminUser/delete',session('admin.nodes')) || session('admin.role_id') == 1): ?>
			str += '<button type="button" class="btn btn-danger btn-xs" title="删除"  onclick="CodeGoods.delete('+row.user_id+')"><i class="fa fa-trash"></i>&nbsp;删除</button>&nbsp;';
			<?php endif; ?>
			return str;
		}
	}

	CodeGoods.statusFormatter = function(value,row,index) {
		if(value !== null){
			if(value == 1){
				return '<input class="mui-switch mui-switch-animbg status'+row.user_id+'" type="checkbox" onclick="CodeGoods.updatestatus('+row.user_id+',0,\'status\')" checked>';
			}else{
				return '<input class="mui-switch mui-switch-animbg status'+row.user_id+'" type="checkbox" onclick="CodeGoods.updatestatus('+row.user_id+',1,\'status\')">';
			}
		}
	}


	CodeGoods.updatestatus = function(pk,value,field) {
		var ajax = new $ax(Feng.ctxPath + "/AdminUser/updateExt", function (data) {
			if ('00' !== data.status) {
				Feng.error(data.msg);
				$("."+field+pk).prop("checked",!$("."+field+pk).prop("checked"));
			}
		});
		var val = $("."+field+pk).prop("checked") ? 1 : 0;
		ajax.set('user_id', pk);
		ajax.set('status', val);
		ajax.start();
	}

	CodeGoods.create_timeFormatter = function(value,row,index) {
		if(value){
			return formatDateTime(value,'Y-m-d H:i:s');	
		}
	}

	CodeGoods.formParams = function() {
		var queryData = {};
		queryData['offset'] = 0;
		queryData['user'] = $("#user").val();
		queryData['role_id'] = $("#role_id").val();
		queryData['status'] = $("#status").val();
		return queryData;
	}

	CodeGoods.check = function () {
		var selected = $('#' + this.id).bootstrapTable('getSelections');
		if(selected.length == 0){
			Feng.info("请先选中表格中的某一记录！");
			return false;
		}else{
			CodeGoods.seItem = selected[0];
			return true;
		}
	};

	CodeGoods.add = function (value) {
		var url = location.search;
		var index = layer.open({type: 2,title: '添加账户',area: ['800px', '550px'],fix: false, maxmin: true,content: Feng.ctxPath + '/AdminUser/add'+url});
		this.layerIndex = index;
		if(!IsPC()){layer.full(index)}
	}


	CodeGoods.update = function (value) {
		if(value){
			var index = layer.open({type: 2,title: '修改账户',area: ['800px', '500px'],fix: false, maxmin: true,content: Feng.ctxPath + '/AdminUser/update?user_id='+value});
			if(!IsPC()){layer.full(index)}
		}else{
			if (this.check()) {
				var idx = this.seItem.user_id;
				var index = layer.open({type: 2,title: '修改账户',area: ['800px', '500px'],fix: false, maxmin: true,content: Feng.ctxPath + '/AdminUser/update?user_id='+idx});
				this.layerIndex = index;
				if(!IsPC()){layer.full(index)}
			}
		}
	}


	CodeGoods.updatePassword = function (value) {
		if(value){
			var index = layer.open({type: 2,title: '修改密码',area: ['600px', '300px'],fix: false, maxmin: true,content: Feng.ctxPath + '/AdminUser/updatePassword?user_id='+value});
			this.layerIndex = index;
			if(!IsPC()){layer.full(index)}
		}else{
			if (this.check()) {
				var idx = this.seItem.user_id;
				var index = layer.open({type: 2,title: '修改密码',area: ['600px', '300px'],fix: false, maxmin: true,content: Feng.ctxPath + '/AdminUser/updatePassword?user_id='+idx});
				this.layerIndex = index;
				if(!IsPC()){layer.full(index)}
			}
		}
	}


	CodeGoods.delete = function (value) {
		if(value){
			Feng.confirm("是否删除选中项？", function () {
				var ajax = new $ax(Feng.ctxPath + "/AdminUser/delete", function (data) {
					if ('00' === data.status) {
						Feng.success(data.msg);
						CodeGoods.table.refresh();
					} else {
						Feng.error(data.msg);
					}
				});
				ajax.set('user_id', value);
				ajax.start();
			});
		}else{
			if (this.check()) {
				var idx = this.seItem.user_id;
				Feng.confirm("是否删除选中项？", function () {
					var ajax = new $ax(Feng.ctxPath + "/AdminUser/delete", function (data) {
						if ('00' === data.status) {
							Feng.success(data.msg,1000);
							CodeGoods.table.refresh();
						} else {
							Feng.error(data.msg,1000);
						}
					});
					ajax.set('user_id', idx);
					ajax.start();
				});
			}
		}
	}


	CodeGoods.search = function() {
		CodeGoods.table.refresh({query : CodeGoods.formParams()});
	};

	$(function() {
		var defaultColunms = CodeGoods.initColumn();
		var url = location.search;
		var table = new BSTable(CodeGoods.id, Feng.ctxPath+"/AdminUser/index"+url,defaultColunms,20);
		table.setPaginationType("server");
		table.setQueryParams(CodeGoods.formParams());
		CodeGoods.table = table.init();
	});
</script>

</div>
<script src="/static/js/content.js?v=1.0.0"></script>

</body>
</html>
