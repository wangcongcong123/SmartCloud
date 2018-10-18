@extends('layouts.app') @section('mycss')

<link rel="stylesheet" href="mycss/main.css">


@endsection @section('content')
<!-- content -->
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<a id="upload" class="btn btn-success btn-block margin-bottom">Upload
				a file</a> <a href="upload.html"
				class="btn btn-primary btn-block margin-bottom">Upload in Batches</a>
			<div class="box box-solid">

				<div class="box-header with-border">
					<h3 class="box-title">Management</h3>
				</div>

				<div class="box-body no-padding">
					<ul class="nav nav-pills nav-stacked" id="leftuptab">
						<li><a href="{{route('main')}}"><i class="fa fa-files-o"></i>
								Files </a></li>
						<li><a href="{{route('upinglist')}}"><i class="fa fa-file"></i>
								Uploading List </a></li>
						<li class="active"><a href="{{route('downinglist')}}"><i
								class="fa fa-file-o"></i> Downloading List<span
								class="label label-warning pull-right">65</span> </a></li>
						<li><a href="{{route('fileshared')}}"><i
								class="fa fa-share-alt-square"></i> File Shared </a></li>
						<li><a href="{{route('trashlist')}}"><i class="fa fa-trash-o"></i>
								Trash</a></li>
					</ul>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /. box -->
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Functions</h3>
				</div>
				<div class="box-body no-padding">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="{{route('contact')}}"><i class="fa fa-exchange"></i>
								Friends</a></li>
						<li><a href="#"><i class="fa fa-user-plus"></i> Help</a></li>
						<li><a href="#"><i class="fa fa-smile-o"></i> Contact us</a></li>
					</ul>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Downloading List</h3>
					<a class="clear-down pull-right" rel="popover"
						data-placement="left" data-content="clear the list"><i
						class="fa fa-trash-o"></i></a>
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive"
						style="overflow-x: auto; overflow-y: auto; height: 500px; width: 100%;">
						<table class="table table-striped table-hover">
						
							<thead>
								<tr  class="info">
									<th style="width: 10px">ID</th>
									<th>Name</th>
									<th>Progress</th>
									<th>Label</th>
									<th>Status</th>
									<th>Speed</th>
									<th>Expect</th>
									<th>Options</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td class="down-id">1.</td>
									<td class="down-name">Download software</td>
									<td class="down-progress">
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-info"
												style="width: 55%"></div>
										</div>
									</td>
									<td class="down-label"><span class="badge bg-green">55%</span></td>
									<td class="down-status"><a class="status-downing">downloading <i
											class="fa fa-spinner"></i></a> <a class="status-finish"
										style="display: none">finished <i
											class="fa fa-hourglass-start"></i></a><a class="status-stop"
										style="display: none">stopped
									</a></td>
									<td class="down-speed"><span class="badge bg-green">233k/s</span></td>
									<td class="down-expect"><span class="badge bg-green">2 minutes</span></td>
									<td class="down-options"><a class="down-start-stop"><i
											class="fa fa-play"></i>&nbsp;&nbsp;&nbsp;</a> <a
										class="down-remove"><i class="fa fa-remove"></i></a></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>

		</div>
	</div>
</section>
<!-- verification modal -->
<div class="modal fade" id="uploadmodal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">

					<label><span class="glyphicon glyphicon-file"></span> Upload Window</label>
				</h4>
			</div>

			<div class="modal-body">
				<form enctype="multipart/form-data" role="form" name="form3"
					id="ff3" method="post" action="#">
					<div class="form-group">
						<label><span class="glyphicon glyphicon-file"></span> <font
							color="red">*</font>Pick a file</label> <input type="file"
							class="form-control" name="afile">
					</div>
					<button type="submit" class=" btn btn-success btn-block">
						<span class="glyphicon glyphicon-upload"></span> upload
					</button>
				</form>

				<div class="progress progress-striped active"
					style="margin-top: 20px">
					<div class="progress-bar progress-bar-info" role="progressbar"
						aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
						style="width: 40%">
						<span>40%</span>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-default pull-right"
					data-dismiss="modal" id="cancelforhost">
					<span class="glyphicon glyphicon-remove"></span> Cancel
				</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="foldermodal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					<label><span class="glyphicon glyphicon-file"></span> Remove File
						Window</label>
				</h4>
			</div>

			<div class="modal-body">
				<div class="zTreeDemoBackground left">
					<ul id="treeDemo" class="ztree"></ul>
				</div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-success pull-right"
					data-dismiss="modal" id="cancelforhost">
					<span class="glyphicon glyphicon-share"></span> Confirm
				</button>

				<button type="button" class="btn btn-danger pull-left"
					data-dismiss="modal" id="cancelforhost">
					<span class="glyphicon glyphicon-remove"></span> Cancel
				</button>

			</div>
		</div>
	</div>
</div>


<!-- create folder modal -->
<div class="modal fade" id="cfoldermodal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					<label><span class="glyphicon glyphicon-file"></span> Create Folder
						Window</label>
				</h4>
			</div>

			<div class="modal-body">

				<form method="post" action="#">
					<div class="form-group">
						<label><span class="glyphicon glyphicon-folder"></span> <font
							color="red">*</font>Enter folder name</label> <input type="text"
							class="form-control" name="cfoldername">
					</div>
				</form>

			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-success pull-right"
					data-dismiss="modal" id="cancelforhost">
					<span class="glyphicon glyphicon-folder"></span> Create
				</button>

				<button type="button" class="btn btn-danger pull-left"
					data-dismiss="modal" id="cancelforhost">
					<span class="glyphicon glyphicon-remove"></span> Cancel
				</button>
			</div>
		</div>
	</div>
</div>


@endsection @section('myjs')

<script type="text/javascript">
$(document).ready(function() {

	$(".clear-down").hover(function(){$(this).popover('show');},function(){$(this).popover('hide');});

	$(".clear-down").click(function(){
		swal('Oops...','clear clicked','info');
	});

	$(".down-start-stop").click(function(){
	
			if($(this).children('i').hasClass('fa fa-play')){
				$(this).children('i').removeClass('fa fa-play').addClass('fa fa-stop');
				$(this).parent().siblings('.down-status').children('.status-stop').show()
				$(this).parent().siblings('.down-status').children('.status-downing').hide()
	
			}else{
				$(this).children('i').removeClass('fa fa-stop').addClass('fa fa-play');
				$(this).parent().siblings('.down-status').children('.status-stop').hide()
				$(this).parent().siblings('.down-status').children('.status-downing').show()
			}
		
	});

	$(".down-remove").click(function(){
		swal('Oops...','remove clicked','info');
	});
	
});

</script>

@endsection
