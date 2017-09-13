<?php include '../system/common.php';?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>项目管理</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/glyphicons.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">


		<!-- 表格-->
		<link href="../css/bootstrap-table.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="../css/dashboard.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="../js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

	<body>
		<?php include '../top.php';?>

		<div class="container-fluid">
			<div class="row addressBar">
				<ol class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Library</a>
					</li>
					<li class="active">Data</li>
				</ol>
			</div>
			<div class="start-btn-sidebar" title="子导航"></div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-2 sidebar">
					<div id="treeview6" class=""></div>
					<ul class="nav nav-sidebar">
						<li >
							<a href="prdManage.php">PRD管理 <span class="sr-only">(current)</span></a>
						</li>
						<li class="active">
							<a href="projectManage.php">项目管理 <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">项目管理</h1>
					<div class="table-responsive no-border">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#creatModal">
						  新增
						</button>
						<button id="editProjectBtn" type="button" class="btn btn-primary btn-lg" data-target="#editModal">
						  编辑
						</button>
						<button id="deleteProjectBtn" type="button" class="btn btn-primary btn-lg">
						  删除
						</button>
						<table id="dataGridTable" class="table table-striped"></table>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- 新增项目Modal -->
		<div class="modal fade" id="creatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">新增项目</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-signin">
							<label for="projectTitle" class="sr-only">项目名称</label>
							<input type="text" id="projectTitle" class="form-control" placeholder="项目名称" required autofocus>
							<label for="projectDec" class="sr-only">用户名</label>
							<textarea id="projectDec" class="form-control" placeholder="项目说明" required></textarea>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		        <button type="button" id="creatProjectInfo" class="btn btn-primary">确定</button>
		      </div>
		      
		    </div>
		  </div>
		</div>
		
		<!-- 编辑用户Modal -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">编辑用户</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-signin">
		        	<input type="hidden" id="editFid">
        			<label for="editProjectTitle" class="sr-only">项目名称</label>
					<input type="text" id="editProjectTitle" class="form-control" placeholder="项目名称" required autofocus>
					<label for="editProjectDec" class="sr-only">用户名</label>
					<textarea id="editProjectDec" class="form-control" placeholder="项目说明" required></textarea>
							
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		        <button type="button" id="editProjectInfo" class="btn btn-primary">确定</button>
		      </div>
		      
		    </div>
		  </div>
		</div>
		
		<!-- Bootstrap core JavaScript
	    ================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<script src="../js/holder.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../js/ie10-viewport-bug-workaround.js"></script>
		<!-- table js 和本地中文补丁 -->
		<script src="../js/bootstrap-table.min.js"></script>
		<script src="../js/bootstrap-table-zh-CN.min.js"></script>
		<script src="../js/common.js"></script>
		<script>
			$(function() {
				
				//请求数据并初始化表格
				var $dataGridTable = $('#dataGridTable');
				$dataGridTable.bootstrapTable({
					url:projectManageReqUrl,
					method:'POST',
					contentType: "application/x-www-form-urlencoded",
                    singleSelect: true,
                    pagination:true,
                    pageSize: 10,  //每页显示的记录数  
		            pageNumber:1, //当前第几页  
		            pageList: [5, 10, 15, 20, 25],  //记录数可选列表  
                    clickToSelect: true,
                    showRefresh: true,  //显示刷新按钮 
                    sidePagination: "server",//order=asc&offset=0&limit=10
                    queryParamsType: "limit",
                    queryParams: function queryParams(params) {
	                    return {
	                          type: 'getProjectList',
      						  pageIndex : params.offset, //当前页面,默认是上面设置的1(pageNumber)
      						  pageSize : params.limit //每一页的数据行数，默认是上面设置的10(pageSize)
	                    };
	                },
	                dataType:'json',
				    columns: [ {
				        field: 'f_project_id',
				        title: '项目ID',
				        visible:false
				    },{
                        field: 'state',
                        checkbox: true,
                        align: 'center',
                        valign: 'middle'
                    },{
				        field: 'f_project_title',
				        title: '项目名称'
				    },{
				        field: 'f_project_description',
				        title: '项目介绍',
				        visible:false
				    },{
				        field: 'f_creat_operator',
				        title: '操作员'
				    }, {
				        field: 'f_creat_time',
				        title: '操作时间',
				    }]
				});
				//新增项目
				$('#creatProjectInfo').click(function() {
					var getProjectTitle = $('#projectTitle').val();
					var getProjectDec = $('#projectDec').val();
					if (getProjectTitle =='' || getProjectDec ==''){
						alert('表单内容不能为空');
						return false;
					}else{
						$.post(projectManageReqUrl, {
								type: 'creatProjectInfo',
								fProjectTitle: getProjectTitle,
								fProjectDec: getProjectDec,
							}, function(data) {

								if(data == 1) {
									alert('创建成功');
									window.location.reload();
								} else {
									alert('创建失败');
								}
							}
						);
					}
				})
				//编辑项目    
				var $editFid= $('#editFid');
				var $editProjectTitle= $('#editProjectTitle');
				var $editProjectDec= $('#editProjectDec');
				//单选列表项目并赋值到编辑弹框中
				$('#editProjectBtn').click(function(){
					var $table = $dataGridTable.bootstrapTable('getSelections');
					//alert($table);
					if ($table!=''){
						
						$.each($table, function(idx, obj) {
							$editFid.val(obj.f_project_id);
							$editProjectTitle.val(obj.f_project_title);
							$editProjectDec.val(obj.f_project_description);
					        //alert(idx+"---"+obj.f_id+"---"+obj.f_projectTitle+"==="+obj.f_projectDec);
					    });
					   $('#editModal').modal('show');
					}else{
						alert("请选择一条记录编辑。")
					}
					
					//alert(JSON.stringify($table));
				})
				//提交编辑 
				$('#editProjectInfo').click(function(){
					var getFid = $editFid.val();
					var getProjectTitle = $editProjectTitle.val();
					var getProjectDec = $editProjectDec.val();
				
					$.post(projectManageReqUrl, {
							type: 'editProjectInfo',
							fid: getFid,
							fProjectTitle: getProjectTitle,
							fProjectDec: getProjectDec
					}, function(data) {
							if(data == 1) {
								alert('修改成功');
								window.location.reload();
							} else {
								alert("修改失败");
							}
						}
					);
					
				})
				//删除项目
				$('#deleteProjectBtn').click(function(){
					alert("暂不实现");
					/*var $table = $dataGridTable.bootstrapTable('getSelections');
					var getUserAccount ;
					if ($table!=''){
						$.each($table, function(idx, obj) {
							getUserAccount = obj.f_account;
					    });
						$.post(projectManageReqUrl, {
								type: 'deteleUserInfo',
								userAccount: getUserAccount
						}, function(data) {
								if(data == 1) {
									alert('删除成功');
									window.location.reload();
								} else {
									alert("删除失败");
								}
							}
						);
					}else{
						alert("请选择一条记录删除。")
					}*/
				})
			});
		</script>
	</body>

</html>