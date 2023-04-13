<?php /*a:2:{s:82:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/new/app/admin/view/log/index.html";i:1605855856;s:90:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/new/app/admin/view/common/_container.html";i:1593828172;}*/ ?>
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
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">应用名称</button>
									</div>
									<select class="form-control" id="application_name">
										<option value="">请选择</option>
										<?php $_result=htmlOutList(\think\facade\Db::query('select app_dir,app_dir from application'),false);if($_result)foreach($_result as $key=>$sql):?>
										<option value="<?php echo $sql['app_dir']; ?>"><?php echo $sql['app_dir']; ?></option>
										<?php endforeach?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">操作用户</button>
									</div>
									<input type="text" autocomplete="off" class="form-control" id="username" placeholder="操作用户" />
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">请求url</button>
									</div>
									<input type="text" autocomplete="off" class="form-control" id="url" placeholder="请求url" />
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">ip</button>
									</div>
									<input type="text" autocomplete="off" class="form-control" id="ip" placeholder="ip" />
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">类型</button>
									</div>
									<select class="form-control" id="type">
										<option value="">请选择</option>
										<option value="1">登录日志</option>
										<option value="2">操作日志</option>
										<option value="3">异常日志</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-btn">
										<button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">创建时间范围</button>
									</div>
									<input type="text" autocomplete="off" placeholder="时间范围" class="form-control" id="create_time">
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
						<?php if(in_array('admin/Log/delete',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="delete" class="btn btn-danger button-margin" onclick="CodeGoods.delete()">
						<i class="fa fa-trash"></i>&nbsp;删除
						</button>
						<?php endif; if(in_array('admin/Log/view',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="view" class="btn btn-info button-margin" onclick="CodeGoods.view()">
						<i class="fa fa-eye"></i>&nbsp;查看详情
						</button>
						<?php endif; if(in_array('admin/Log/dumpData',session('admin.nodes')) || session('admin.role_id') == 1): ?>
						<button type="button" id="dumpData" class="btn btn-warning button-margin" onclick="CodeGoods.dumpData()">
						<i class="fa fa-download"></i>&nbsp;导出
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
 			{field: 'selectItem', checkbox: true},
 			{title: '编号', field: 'id', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '应用名称', field: 'application_name', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '操作用户', field: 'username', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '请求url', field: 'url', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: 'ip', field: 'ip', visible: true, align: 'center', valign: 'middle',sortable: true},
 			{title: '类型', field: 'type', visible: true, align: 'center', valign: 'middle',sortable: true,formatter:CodeGoods.typeFormatter},
 			{title: '创建时间', field: 'create_time', visible: true, align: 'center', valign: 'middle',sortable: true,formatter:CodeGoods.create_timeFormatter},
 			{title: '操作', field: '', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.buttonFormatter'},
 		];
 	};

	CodeGoods.buttonFormatter = function(value,row,index) {
		if(row.id){
			var str= '';
			<?php if(in_array('admin/Log/delete',session('admin.nodes')) || session('admin.role_id') == 1): ?>
			str += '<button type="button" class="btn btn-danger btn-xs" title="删除"  onclick="CodeGoods.delete('+row.id+')"><i class="fa fa-trash"></i>&nbsp;删除</button>&nbsp;';
			<?php endif; ?>
			return str;
		}
	}

	CodeGoods.typeFormatter = function(value,row,index) {
		if(value !== null){
			var value = value.toString();
			switch(value){
				case '1':
					return '<span class="label label-primary">登录日志</span>';
				break;
				case '2':
					return '<span class="label label-success">操作日志</span>';
				break;
				case '3':
					return '<span class="label label-danger">异常日志</span>';
				break;
			}
		}
	}

	CodeGoods.create_timeFormatter = function(value,row,index) {
		if(value){
			return formatDateTime(value,'Y-m-d H:i:s');	
		}
	}

	CodeGoods.formParams = function() {
		var queryData = {};
		queryData['offset'] = 0;
		queryData['application_name'] = $("#application_name").val();
		queryData['username'] = $("#username").val();
		queryData['url'] = $("#url").val();
		queryData['ip'] = $("#ip").val();
		queryData['type'] = $("#type").val();
		queryData['create_time_start'] = $("#create_time").val().split(" - ")[0];
		queryData['create_time_end'] = $("#create_time").val().split(" - ")[1];
		return queryData;
	}

	CodeGoods.check = function () {
		var selected = $('#' + this.id).bootstrapTable('getSelections');
		if(selected.length == 0){
			Feng.info("请先选中表格中的某一记录！");
			return false;
		}else{
			CodeGoods.seItem = selected;
			return true;
		}
	};

	CodeGoods.delete = function (value) {
		if(value){
			Feng.confirm("是否删除选中项？", function () {
				var ajax = new $ax(Feng.ctxPath + "/Log/delete", function (data) {
					if ('00' === data.status) {
						Feng.success(data.msg);
						CodeGoods.table.refresh();
					} else {
						Feng.error(data.msg);
					}
				});
				ajax.set('id', value);
				ajax.start();
			});
		}else{
			if (this.check()) {
				var idx = '';
				$.each(CodeGoods.seItem, function() {
					idx += ',' + this.id;
				});
				idx = idx.substr(1);
				Feng.confirm("是否删除选中项？", function () {
					var ajax = new $ax(Feng.ctxPath + "/Log/delete", function (data) {
						if ('00' === data.status) {
							Feng.success(data.msg,1000);
							CodeGoods.table.refresh();
						} else {
							Feng.error(data.msg,1000);
						}
					});
					ajax.set('id', idx);
					ajax.start();
				});
			}
		}
	}


	CodeGoods.view = function (value) {
		if(value){
			var index = layer.open({type: 2,title: '查看详情',area: ['800px', '600px'],fix: false, maxmin: true,content: Feng.ctxPath + '/Log/view?id='+value});
			if(!IsPC()){layer.full(index)}
		}else{
			if (this.check()) {
				var idx = '';
				$.each(CodeGoods.seItem, function() {
					idx += ',' + this.id;
				});
				idx = idx.substr(1);
				if(idx.indexOf(",") !== -1){
					Feng.info("请选择单条数据！");
					return false;
				}
				var index = layer.open({type: 2,title: '查看详情',area: ['800px', '600px'],fix: false, maxmin: true,content: Feng.ctxPath + '/Log/view?id='+idx});
				this.layerIndex = index;
				if(!IsPC()){layer.full(index)}
			}
		}
	}


	CodeGoods.dumpData = function (value) {
		var select_id = '';
		if (this.check()){
			$.each(CodeGoods.seItem, function() {
				select_id += ',' + this.id;
			});
		}
		select_id = select_id.substr(1);
		Feng.confirm("是否确定导出记录?", function() {
			var index = layer.msg('正在导出下载，请耐心等待...', {
				time : 3600000,
				icon : 16,
				shade : 0.01
			});
			var idx =[];
			$("li input:checked").each(function(){
				idx.push($(this).attr('data-field'));
			});
			var queryData = CodeGoods.formParams();
			window.location.href = Feng.ctxPath + '/Log/dumpData?action_id=670&' + Feng.parseParam(queryData) + '&' +Feng.parseParam(idx) + '&id=' + select_id;
			setTimeout(function() {
				layer.close(index)
			}, 1000);
		});
	}


	CodeGoods.search = function() {
		CodeGoods.table.refresh({query : CodeGoods.formParams()});
	};

	$(function() {
		var defaultColunms = CodeGoods.initColumn();
		var url = location.search;
		var table = new BSTable(CodeGoods.id, Feng.ctxPath+"/Log/index"+url,defaultColunms,20);
		table.setPaginationType("server");
		table.setQueryParams(CodeGoods.formParams());
		CodeGoods.table = table.init();
	});
	laydate.render({elem: '#create_time',type: 'datetime',range:true});
</script>

</div>
<script src="/static/js/content.js?v=1.0.0"></script>

</body>
</html>
