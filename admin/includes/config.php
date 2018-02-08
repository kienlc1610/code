<?php include_once 'class/xl_cau_hinh.php'; 
	$dt_cauhinh = new xl_cau_hinh();
	if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['ma']) && $_GET['ma'] != '')
	{
		if($dt_cauhinh->xoa($_GET['ma']))
			$thongbao = 'Xóa thành công';
		else
			$thongbao = 'Xóa không thành công';
		echo '<script>history.pushState({}, "", "main.php?views=config" );</script>';
	}
	if(isset($_POST) && isset($_POST['del']) && $_POST['del']== 'delall' && isset($_POST['check']) && count($_POST['check'])>0)
	{
		foreach($_POST['check'] as $ma){
			if($dt_cauhinh->xoa($ma))
				$thongbao = 'Xóa thành công';
		}
		//echo '<script>history.pushState({}, "", "main.php?views=news" );</script>';
	}
	$ds = $dt_cauhinh->danh_sach();
?>
            <!-- content starts -->
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	
    <div class="box-header well" data-original-title="">
		
        <h2><i class="glyphicon glyphicon-user"></i> Danh sách cấu hình hệ thống</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default hidden"><i class="glyphicon glyphicon-remove "></i></a>
        </div>
    </div>
    <div class="box-content">
   <?php if(isset($thongbao) && $thongbao!=''){ ?><div class="alert alert-info"><?php echo @$thongbao; ?> </div><?php } ?>
   <form method="post" action="">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th  class="no-sort"><input type="checkbox" onclick="checkall(this.checked)" value="" id="all" /></th>
        <th  class="no-sort">Tên cấu hình</th>
        <th>Giá trị</th>
       
        <th>Tác vụ</th>
    </tr>
    </thead>
    <tbody>
	<?php if($ds){
	foreach($ds as $tin){
	?>
    <tr>
		<td><input type="checkbox" name="check[]" value="<?php echo $tin->ma ?>"/></td>
        <td><?php echo $tin->ten ?></td>
        <td class="center"><?php echo $tin->giatri ?></td>
       
        
		<td class="center">
          <!--  <a class="btn btn-success" href="#">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Chi tiết
            </a>-->
            <a class="btn btn-info" href="?views=editconfig&ma=<?php echo $tin->ma ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Cập nhật
            </a>
            <!--<a class="btn btn-danger" href="?views=config&action=del&ma=<?php echo $tin->ma ?>" onclick="return xacnhan()">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Xóa
            </a>-->
        </td>
    </tr>
	<?php
		}
	}
	?>
    </tbody>
    </table>
	<a class="btn btn-success" href="?views=addconfig">
		<i class="glyphicon glyphicon-plus icon-white"></i>
		Thêm mới
    </a>
	<!--<button class="btn btn-danger" type="submit" name="del" onclick="return xacnhan()" value="delall">
		<i class="glyphicon glyphicon-trash icon-white"></i>
		Xóa các mục đang chọn-->
    </button>
	</form>
    </div>
    </div>
    </div>
    <!--/span-->
</div>

    <!-- content ends -->