<?php /*a:2:{s:72:"/www/wwwroot/lr/new/app/admin/controller/Sys/view/application/index.html";i:1586657294;s:57:"/www/wwwroot/lr/new/app/admin/view/common/_container.html";i:1593828172;}*/ ?>
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
						<div class="btn-group-sm" id="CodeGoodsTableToolbar" role="group">
							<button type="button" class="btn btn-success button-margin" onclick="CodeGoods.add()">
								<i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 创建
							</button>
							<button type="button" class="btn btn-primary button-margin" onclick="CodeGoods.update()">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> 修改
							</button>
							<button type="button" class="btn btn-danger button-margin" onclick="CodeGoods.delete()">
								<i class="glyphicon glyphicon-trash" aria-hidden="true" ></i> 卸载
							</button>
							<button type="button" class="btn btn-warning button-margin" onclick="CodeGoods.createApplication()">
								<i class="glyphicon glyphicon-pencil"></i>&nbsp;生成应用
							</button>
						</div>
						<table id="CodeGoodsTable" data-mobile-responsive="true"></table>
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
 			{title: '编号', field: 'app_id', visible: true, align: 'center', valign: 'middle'},
 			{title: '应用名', field: 'name', visible: true, align: 'center', valign: 'middle'},
 			{title: '应用目录', field: 'app_dir', visible: true, align: 'center', valign: 'middle'},	
 			{title: '应用类型', field: 'app_type', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.moudle_typeFormatter'},
 			{title: '登录数据表', field: 'login_table', visible: true, align: 'center', valign: 'middle'},
 			{title: '登录字段', field: 'login_fields', visible: true, align: 'center', valign: 'middle'},
 			{title: '绑定域名', field: 'domain', visible: true, align: 'center', valign: 'middle'},
			{title: '生成状态', field: 'status', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.statusFormatter'},
			{title: '操作', field: 'domain', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.domainFormatter'},
 		];
 	};
	
	CodeGoods.domainFormatter = function(value,row,index) {
		var str= '';
		var ApplicationName = row.app_dir;
		var domain = row.domain;
		str += '<button type="button" style="font-size:12px;" class="btn btn-warning btn-xs" onclick="CodeGoods.gourl(\''+ApplicationName+'\',\''+domain+'\')"><i class="fa fa-share"></i> 点击访问</button>&nbsp;'
		return str;
	}
	
	CodeGoods.gourl = function(ApplicationName,domain){
		if(domain !== ''){
			window.open(domain);
		}else{
			window.open('/'+ApplicationName);
		}
	}

	CodeGoods.statusFormatter = function(value,row,index) {
		if(value !== null){
			var value = value.toString();
			switch(value){
				case '1':
					return '<span class="label label-primary">启用</span>';
				break;
				case '0':
					return '<span class="label label-danger">禁用</span>';
				break;
			}
		}
	}
	
	CodeGoods.is_groupFormatter = function(value,row,index) {
		if(value !== null){
			var value = value.toString();
			switch(value){
				case '1':
					return '<span class="label label-primary">是</span>';
				break;
				case '0':
					return '<span class="label label-danger">否</span>';
				break;
			}
		}
	}

	CodeGoods.moudle_typeFormatter = function(value,row,index) {
		if(value !== null){
			var value = value.toString();
			switch(value){
				case '1':
					return '<span class="label label-primary">后台管理</span>';
				break;
				case '2':
					return '<span class="label label-success">接口生成</span>';
				break;
				case '3':
					return '<span class="label label-warning">cms</span>';
				break;
			}
		}
	}

	CodeGoods.formParams = function() {
		var queryData = {};
		queryData['name'] = $("#name").val();
		queryData['status'] = $("#status").val();
		queryData['domain'] = $("#domain").val();
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
		var index = layer.open({type: 2,title: '创建应用',area: ['1100px', '600px'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Application/add'+url});
		this.layerIndex = index;
	}


	CodeGoods.update = function (value) {

		if (this.check()) {
			app_id = this.seItem.app_id;
			if(app_id == 1){
				Feng.error("禁止修改！");
				return false;
			}
			var index = layer.open({type: 2,title: '修改模块',area: ['1100px', '600px'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Application/update?app_id='+ app_id});
			this.layerIndex = index;
		}
		
	}
	
	CodeGoods.createApplication = function() {
		if (this.check()) {
			var tip = '确定操作';
			var app_id = this.seItem.app_id;
			var status = this.seItem.status;
			if(app_id == 1 || status == 0){
				Feng.error("禁止生成！");
				return false;
			}
			var operation = function() {
				var ajax = new $ax(Feng.ctxPath + "/Sys.Application/createApplication",
						function(data) {
							if ('00' === data.status) {
								Feng.success(data.msg);
								CodeGoods.table.refresh();
							} else{
								Feng.error(data.msg + "！", 10000);
							}
						});
				ajax.set("app_id", app_id);
				ajax.start();
			};
			Feng.confirm("是否" + tip, operation);
		}
	};
	
	CodeGoods.delete = function(type) {
		if (this.check()) {
			var tip = '确定操作';
			var app_id = this.seItem.app_id;
			if(app_id == 1){
				Feng.error("禁止删除！");
				return false;
			}
			var operation = function() {
				var ajax = new $ax(Feng.ctxPath + "/Sys.Application/delete",
						function(data) {
							if ('00' === data.status) {
								Feng.success(data.msg);
								CodeGoods.table.refresh();
							} else{
								Feng.error(data.msg + "！", 10000);
							}
						});
				ajax.set("app_id", app_id);
				ajax.start();
				
				
			};
			Feng.confirm("是否" + tip, operation);
		}
	};


	CodeGoods.search = function() {
		CodeGoods.table.refresh({query : CodeGoods.formParams()});
	};

	CodeGoods.orderby = function() {
		var queryData = CodeGoods.formParams();
		queryData['orderby'] = $("#orderby").val();
		CodeGoods.table.refresh({query : queryData});
	};

	$(function() {
		var defaultColunms = CodeGoods.initColumn();
		var url = location.search;
		var table = new BSTable(CodeGoods.id, Feng.ctxPath + "/Sys.Application/index"+url,defaultColunms,20);
		table.setPaginationType("server");
		table.setQueryParams(CodeGoods.formParams());
		CodeGoods.table = table.init();
	});
</script>

</div>
<script src="/static/js/content.js?v=1.0.0"></script>

</body>
</html>
