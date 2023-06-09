<?php /*a:2:{s:105:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/news/app/admin/controller/Sys/view/menu/admin_index.html";i:1593962862;s:91:"/www/wwwroot/3.0xingu/xingupeizi/xingu.dxcfd.com/news/app/admin/view/common/_container.html";i:1593828172;}*/ ?>
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
				<div class="layui-tab layui-tab-brief" lay-filter="test" style="margin-top:-10px;">
					<ul class="layui-tab-title">
						<?php $_result=htmlOutList(db('application')->where("1=1")->select()->toArray(),false);if($_result)foreach($_result as $key=>$query):?>
						<li <?php if($app_id == $query['app_id']): ?>class="layui-this"<?php endif; ?> onclick="location.href='<?php echo url('admin/Sys.Menu/index',['app_id'=>$query['app_id']]); ?>'"><?php if($query['app_type'] == 3): ?>cms文章模型管理<?php else: ?><?php echo $query['name']; ?><?php endif; ?></li>
						<?php endforeach;else?><?php echo "";?>
					</ul>
				</div>
				<div class="row row-lg">
					<div class="col-sm-12">
						<div class="btn-group-sm" id="CodeGoodsTableToolbar" role="group">
							<button type="button" class="btn btn-primary button-margin" onclick="CodeGoods.add()">
								<i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 创建
							</button>
							<button type="button" class="btn btn-primary button-margin" onclick="CodeGoods.update()">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> 修改
							</button>
							<button type="button" class="btn btn-warning button-margin" onclick="CodeGoods.fieldlist()">
								<i class="glyphicon glyphicon-plus"></i>&nbsp;字段管理
							</button>
							<button type="button" class="btn btn-warning button-margin" onclick="CodeGoods.actionlist()">
								<i class="glyphicon glyphicon-plus"></i>&nbsp;方法管理
							</button>
							<button type="button" class="btn btn-success button-margin" onclick="CodeGoods.createCode()">
								<i class="glyphicon glyphicon-plus"></i>&nbsp;生成代码
							</button>
							<button type="button" class="btn btn-danger button-margin" onclick="CodeGoods.delete()">
								<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> 卸载
							</button>
							<select style="border:1px solid #ddd;" class="btn" id="copyMenuData">
								<option value="">复制到</option>
								<?php $_result=htmlOutList(db('application')->where("1=1")->select()->toArray(),false);if($_result)foreach($_result as $key=>$query):?>
								<option value="<?php echo $query['app_id']; ?>"><?php echo $query['name']; ?></option>
								<?php endforeach;else?><?php echo "";?>
							</select>
							<button type="button" class="btn btn-primary button-margin btn-sm" onclick="CodeGoods.copyMenu()" id="">
								<i class="fa fa-check"></i>&nbsp;确定
							</button>
							<select style="border:1px solid #ddd; width:180px; height:24px;" class="btn chosen" id="tableData">
								<option value="">根据表生成</option>
								<?php if(is_array($tableList) || $tableList instanceof \think\Collection || $tableList instanceof \think\Paginator): $i = 0; $__LIST__ = $tableList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<button type="button" class="btn btn-primary button-margin btn-sm" onclick="CodeGoods.createMenuByTable()" id="">
								<i class="fa fa-check"></i>&nbsp;确定
							</button>
						</div>
						<table id="CodeGoodsTable" data-mobile-responsive="true"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<link href='/static/js/plugins/chosen/chosen.min.css' rel='stylesheet'/>
<script src='/static/js/plugins/chosen/chosen.jquery.js'></script>
<script>

	$(function(){$('.chosen').chosen({})})

	var CodeGoods = {id: "CodeGoodsTable",seItem: null,table: null,layerIndex: -1};

	CodeGoods.initColumn = function () {
 		return [
 			{field: 'selectItem', radio: true},
 			{title: '编号', field: 'menu_id', visible: true, align: 'lelf', valign: 'middle'},
			{title: '排序', field: 'menu_id', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.arrowFormatter'},
 			{title: '名称', field: 'cname', visible: true, align: 'lelf', valign: 'middle'},
 			{title: '名称', field: 'title', visible: false, align: 'lelf', valign: 'middle'},
			{title: '控制器名', field: 'controller_name', visible: true, align: 'lelf', valign: 'middle'},
 			{title: '数据库表名', field: 'table_name', visible: true, align: 'left', valign: 'middle'},
			{title: '是否生成代码', field: 'is_create', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.is_createFormatter'},
			{title: '显示菜单', field: 'status', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.statusFormatter'},
			{title: '创建数据库表', field: 'table_status', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.tableFormatter'},	
			{title: '排序号', field: 'sortid', visible: true, align: 'left', valign: 'middle',formatter: 'CodeGoods.sortFormatter'},
			{title: '操作', field: 'menu_id', visible: true, align: 'center', valign: 'middle',formatter: 'CodeGoods.buttonFormatter'},
 		];
 	};
	
	CodeGoods.is_createFormatter = function(value,row,index) {
		if(value !== null){
			if(value == 1){
				return '<input class="mui-switch mui-switch-animbg status'+row.menu_id+'" type="checkbox" onclick="CodeGoods.updateis_create('+row.menu_id+',0)" checked>';
			}else{
				return '<input class="mui-switch mui-switch-animbg status'+row.menu_id+'"  type="checkbox" onclick="CodeGoods.updateis_create('+row.menu_id+',1)">';
			}
		}
	}
	
	CodeGoods.updateis_create = function(pk,value) {
		var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/updateExt", function (data) {
			if ('00' === data.status) {
				location.replace(location);
			} else {
				Feng.error(data.msg);
				$(".status"+pk).prop("checked",!$(".status"+pk).prop("checked"));
			}
		});
		var val = $(".status"+pk).prop("checked") ? 1 : 0;
		ajax.set('menu_id', pk);
		ajax.set('is_create', value);
		ajax.start();
	}
	
	
	CodeGoods.statusFormatter = function(value,row,index) {
		if(value !== null){
			if(value == 1){
				return '<input class="mui-switch mui-switch-animbg status'+row.menu_id+'" type="checkbox" onclick="CodeGoods.updatestatus('+row.menu_id+',0)" checked>';
			}else{
				return '<input class="mui-switch mui-switch-animbg status'+row.menu_id+'"  type="checkbox" onclick="CodeGoods.updatestatus('+row.menu_id+',1)">';
			}
		}
	}
	
	CodeGoods.updatestatus = function(pk,value) {
		var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/updateExt", function (data) {
			if ('00' === data.status) {
			} else {
				Feng.error(data.msg);
				$(".status"+pk).prop("checked",!$(".status"+pk).prop("checked"));
			}
		});
		var val = $(".status"+pk).prop("checked") ? 1 : 0;
		ajax.set('menu_id', pk);
		ajax.set('status', value);
		ajax.start();
	}
	
	CodeGoods.tableFormatter = function(value,row,index) {
		switch(value){
			case 1:
				return '<span class="label label-success ">是</div>';
			break;
			case 0:
				return '<span class="label label-warning ">否</div>';
			break;
		}
	}
	
	
	CodeGoods.buttonFormatter = function(value,row,index) {
		if(value){
			var str= '';
			str += '<button type="button" class="btn btn-primary btn-xs" title="修改"  onclick="CodeGoods.update('+value+')"><i class="fa fa-edit"></i> 修改</button>&nbsp;'
			str += '<button type="button" class="btn btn-danger btn-xs" title="卸载"  onclick="CodeGoods.delete('+value+')"><i class="fa fa-trash"></i> 卸载</button>&nbsp;'
			return str;
		}
	}
	
	CodeGoods.sortFormatter = function(value,row,index) {
		return '<input type="text" value="'+value+'" onblur="CodeGoods.upsort('+row.menu_id+',this.value)" style="width:50px; border:1px solid #ddd; text-align:center">';
	}

	CodeGoods.formParams = function() {
		var queryData = {};
		queryData['module_id'] = $("#module_id").val();
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

	CodeGoods.add = function () {
		var index = layer.open({type: 2,title: '创建菜单',area: ['900px', '100%'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Menu/add?app_id=<?php echo $app_id; ?>'});
		this.layerIndex = index;
	}
	
	CodeGoods.createCode = function(type) {
		if (this.check()) {
			var tip = '确定操作';
			var menu_id = this.seItem.menu_id;
			var is_create = this.seItem.is_create;
			if(is_create == 0){
				Feng.error("禁止生成模块！");
				return false;
			}
			var operation = function() {
				var ajax = new $ax(Feng.ctxPath + "/Sys.Build/create",
						function(data) {
							if ('00' === data.status) {
								Feng.success(data.msg);
							} else{
								Feng.error(data.msg + "！", 10000);
							}
						});
				ajax.set("menu_id", menu_id);
				ajax.start();
				
				
			};
			Feng.confirm("是否" + tip, operation);
		}
	};
	
	
	CodeGoods.delete = function(value) {
		var tip = '确定操作吗？';
		if(value){
			Feng.confirm(tip, function () {
				var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/delete", function (data) {
					if ('00' === data.status) {
						Feng.success(data.msg);
						CodeGoods.table.refresh();
					} else {
						Feng.error(data.msg);
					}
				});
				ajax.set('menu_id', value);
				ajax.start();
			});
		}else{
			if (this.check()) {
				var menu_id = this.seItem.menu_id;
				var operation = function() {
					var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/delete",
							function(data) {
								if ('00' === data.status) {
									Feng.success(data.msg);
									CodeGoods.table.refresh();
								} else{
									Feng.error(data.msg + "！", 1000);
								}
							});
					ajax.set("menu_id", menu_id);
					ajax.start();
					
					
				};
				Feng.confirm("是否" + tip, operation);
			}
		}
	};
	
	CodeGoods.copyMenu = function(type) {
		if (this.check()) {
			var tip = '确定操作';
			var app_id = $("#copyMenuData").val();
			var menu_id = this.seItem.menu_id;
			var operation = function() {
				var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/copyMenu",
						function(data) {
							if ('00' === data.status) {
								Feng.success(data.msg);
								CodeGoods.table.refresh();
							} else{
								Feng.error(data.msg + "！", 1000);
							}
						});
				ajax.set("app_id", app_id);
				ajax.set("menu_id", menu_id);
				ajax.start();
			};
			Feng.confirm("是否" + tip, operation);
		}
	};
	
	CodeGoods.createMenuByTable = function(type) {
		var tip = '确定操作';
		var table_name = $("#tableData").val();
		if(!table_name){
			Feng.error('请选择数据表', 1000);
			return false;
		}
		var operation = function() {
			var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/createModuleByTable",
					function(data) {
						if ('00' === data.status) {
							var ajax = new $ax(Feng.ctxPath + "/Sys.Build/create",
									function(data) {
										if ('00' === data.status) {
											Feng.success(data.msg);
											CodeGoods.table.refresh();
										} else{
											Feng.error(data.msg + "！", 10000);
										}
									});
							ajax.set("menu_id", data.menu_id);
							ajax.start();
						} else{
							Feng.error(data.msg + "！", 1000);
						}
					});
			ajax.set("table_name", table_name);
			ajax.start();
		};
		Feng.confirm("是否" + tip, operation);	
	};

	CodeGoods.update = function (value) {
		if(value){
			var index = layer.open({type: 2,title: '修改菜单',area: ['900px', '100%'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Menu/update?menu_id='+value});
		}else{
			if (this.check()) {
				var idx = this.seItem.menu_id;
				var index = layer.open({type: 2,title: '修改菜单',area: ['900px', '100%'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Menu/update?menu_id='+idx});
				this.layerIndex = index;
			}
		}
	}


	CodeGoods.fieldlist = function () {
		if (this.check()) {
			var idx = this.seItem.menu_id;
			var name = this.seItem.title;
			var index = layer.open({type: 2,title: name + ' 字段管理',area: ['99%', '99%'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Field/index?menu_id='+idx});
			this.layerIndex = index;
		}
	}


	CodeGoods.actionlist = function () {
		if (this.check()) {
			var idx = this.seItem.menu_id;
			var name = this.seItem.title;
			var index = layer.open({type: 2,title: name + ' 操作列表',area: ['99%', '99%'],fix: false, maxmin: true,content: Feng.ctxPath + '/Sys.Action/index?menu_id='+idx});
			this.layerIndex = index;
		}
	}
	
	CodeGoods.arrowFormatter = function(value,row,index) {
		return '<i class="fa fa-long-arrow-up" onclick="CodeGoods.arrowsort('+value+',1)" style="cursor:pointer;" title="上移"></i>&nbsp;<i class="fa fa-long-arrow-down" style="cursor:pointer;" onclick="CodeGoods.arrowsort('+value+',2)"  title="下移"></i>';
	}
	
	CodeGoods.arrowsort = function (value,type) {
		var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/arrowsort", function (data) {
			if ('00' === data.status) {
					Feng.success(data.msg);
					CodeGoods.table.refresh();
			} else {
				Feng.error(data.msg);
			}
		});
		ajax.set('menu_id', value);
		ajax.set('type', type);
		ajax.start();
	}
	
	CodeGoods.upsort = function(id,sortid)
    {
		var ajax = new $ax(Feng.ctxPath + "/Sys.Menu/setSort", function (data) {
			if ('00' === data.status) {
			} else {
				Feng.error(data.msg);
			}
		});
		ajax.set('sortid', sortid);
		ajax.set('id', id);
		ajax.start();
    }


	CodeGoods.search = function() {
		CodeGoods.table.refresh({query : CodeGoods.formParams()});
	};

	$(function() {
		var defaultColunms = CodeGoods.initColumn();
		var table = new BSTable(CodeGoods.id, Feng.ctxPath + "/Sys.Menu/index?app_id=<?php echo $app_id; ?>",defaultColunms,200);
		table.setPaginationType("server");
		table.setQueryParams(CodeGoods.formParams());
		CodeGoods.table = table.init();
	});
</script>

</div>
<script src="/static/js/content.js?v=1.0.0"></script>

</body>
</html>
