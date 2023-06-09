
CodeInfoDlg.clearData = function () {
	 this.CodeInfoData = {};
};


CodeInfoDlg.set = function (key, val) {
	 this.CodeInfoData[key] = (typeof value == "undefined") ? $("#" + key).val() : value;
	 return this;
};


CodeInfoDlg.get = function (key) {
	 return $("#" + key).val();
};


CodeInfoDlg.close = function () {
	 var index = parent.layer.getFrameIndex(window.name);
	 parent.layer.close(index);
};

CodeInfoDlg.validate = function () {
	return true;
	  $('#CodeInfoForm').data("bootstrapValidator");
	  $('#CodeInfoForm').bootstrapValidator('validate');
	  return $("#CodeInfoForm").data('bootstrapValidator').isValid();
};

CodeInfoDlg.zuijia = function (classname) {
	$('.'+classname).clone().insertBefore('.'+classname);
};


$(function () {
	Feng.initValidator("CodeInfoForm", CodeInfoDlg.validateFields);
});



