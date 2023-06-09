
var Feng = {
    ctxPath: "",
    addCtx: function (ctx) {
        if (this.ctxPath == "") {
            this.ctxPath = ctx;
        }
    },
    confirm: function (tip, ensure) {//询问框
        parent.layer.confirm(tip, {
            btn: ['确定', '取消']
        }, function (index) {
            ensure();
            parent.layer.close(index);
        }, function (index) {
            parent.layer.close(index);
        });
    },
    log: function (info) {
        console.log(info);
    },
    alert: function (info, iconIndex, time) {
        parent.layer.msg(info, {
            icon: iconIndex,
            time:time
        });
    },
    info: function (info) {
        Feng.alert(info, 0);
    },
    success: function (info,time) {
        Feng.alert(info, 1,1000);
    },
    error: function (info, time) {
        Feng.alert(info, 2, 3000);
    },
    infoDetail: function (title, info) {
        var display = "";
        if (typeof info == "string") {
            display = info;
        } else {
            if (info instanceof Array) {
                for (var x in info) {
                    display = display + info[x] + "<br/>";
                }
            } else {
                display = info;
            }
        }
        parent.layer.open({
            title: title,
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['950px', '600px'], //宽高
            content: '<div style="padding: 20px;">' + display + '</div>'
        });
    },
    writeObj: function (obj) {
        var description = "";
        for (var i in obj) {
            var property = obj[i];
            description += i + " = " + property + ",";
        }
        layer.alert(description, {
            skin: 'layui-layer-molv',
            closeBtn: 0
        });
    },
    showInputTree: function (inputId, inputTreeContentId, leftOffset, rightOffset) {
        var onBodyDown = function (event) {
            if (!(event.target.id == "menuBtn" || event.target.id == inputTreeContentId || $(event.target).parents("#" + inputTreeContentId).length > 0)) {
                $("#" + inputTreeContentId).fadeOut("fast");
                $("body").unbind("mousedown", onBodyDown);// mousedown当鼠标按下就可以触发，不用弹起
            }
        };

        if(leftOffset == undefined && rightOffset == undefined){
            var inputDiv = $("#" + inputId);
            var inputDivOffset = $("#" + inputId).offset();
            $("#" + inputTreeContentId).css({
                left: inputDivOffset.left + "px",
                top: inputDivOffset.top + inputDiv.outerHeight() + "px"
            }).slideDown("fast");
        }else{
            $("#" + inputTreeContentId).css({
                left: leftOffset + "px",
                top: rightOffset + "px"
            }).slideDown("fast");
        }

        $("body").bind("mousedown", onBodyDown);
    },
    baseAjax: function (url, tip) {
        var ajax = new $ax(url, function (data) {
//        var ajax = new $ax(Feng.ctxPath + url, function (data) {
			if (1===parseInt(data.code)) {
				Feng.success(tip + "成功！" + data.msg + "！");
			} else {
				Feng.error(tip + "失败！" + data.msg + "！");
			}
        }, function (data) {
            Feng.error(tip + "失败！" + data.responseJSON.message + "！");
        });
        return ajax;
    },
    changeAjax: function (url) {
        return Feng.baseAjax(url, "修改");
    },
    zTreeCheckedNodes: function (zTreeId) {
        var zTree = $.fn.zTree.getZTreeObj(zTreeId);
        var nodes = zTree.getCheckedNodes();
        var ids = "";
        for (var i = 0, l = nodes.length; i < l; i++) {
            ids += "," + nodes[i].id;
        }
        return ids.substring(1);
    },
    eventParseObject: function (event) {//获取点击事件的源对象
        event = event ? event : window.event;
        var obj = event.srcElement ? event.srcElement : event.target;
        return $(obj);
    },
    sessionTimeoutRegistry: function () {
        $.ajaxSetup({
            contentType: "application/x-www-form-urlencoded;charset=utf-8",
            complete: function (XMLHttpRequest, textStatus) {
                //通过XMLHttpRequest取得响应头，sessionstatus，
                var sessionstatus = XMLHttpRequest.getResponseHeader("sessionstatus");
                if (sessionstatus == "timeout") {
                    //如果超时就处理 ，指定要跳转的页面
                    window.location = Feng.ctxPath + "/global/sessionError";
                }
            }
        });
    },
    initValidator: function(formId,fields){
        $('#' + formId).bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: fields,
            live: 'enabled',
			submitButtons: '#ensure',
            message: '该字段不能为空'
        });
    },
    
  //js将json格式的对象拼接成复杂的url参数方法
  //调用： 
  //var obj={name:'tom','class':{className:'class1'},classMates:[{name:'lily'}]};
  //parseParam(obj); 
  //结果："name=tom&class.className=class1&classMates[0].name=lily" 
  //parseParam(obj,'stu');
  //结果："stu.name=tom&stu.class.className=class1&stu.classMates[0].name=lily"
    parseParam : function(param, key){ 
		var paramStr=""; 
		if(param instanceof String||param instanceof Number||param instanceof Boolean){ 
			paramStr += "&" + key + "=" + encodeURIComponent(param); 
		}else{ 
			$.each(param, function(i, k){ 
				var k= (key==null) ? i : key+(param instanceof Array ? "["+i+"]" : "." + i); 
				if (!(this instanceof Window)) {
					paramStr += '&' + Feng.parseParam(this, k); 
				}
			}); 
		} 
		return paramStr.substr(1); 
	}
};

 

