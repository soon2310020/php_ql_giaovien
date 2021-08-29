<?php
    //kiểm tra thêm bộ môn
    if(isset($_POST["addForm"])){

      $form = $_POST["addForm"];

      $bomon = new Bomon();

      $status = $bomon->ThemBoMon($form["maBoMon"],$form["tenBoMon"],$form["maKhoa"],$form["moTa"]);
      
      if(!$status){
        echo '<script>alert("Có lỗi xảy ra khi thực hiện truy vấn");</script>';
      }
    }
    //kiểm tra sửa bộ môn
    if(isset($_POST["editForm"])){

      $form = $_POST["editForm"];

      $bomon = new Bomon();

      $status = $bomon->SuaBoMon($form["maBoMon"],$form["tenBoMon"],$form["maKhoa"],$form["moTa"]);
      //echo $status;
      if(!$status){
        echo '<script>alert("Có lỗi xảy ra khi thực hiện truy vấn");</script>';
      }
    }

    //kiểm tra xóa bộ môn
    if(isset($_POST["deleteForm"])){

      $mabomon = $_POST["deleteForm"]["maBoMon"];

      $bomon = new Bomon();

      $status = $bomon->XoaBoMon($mabomon);

      if(!$status){
        echo '<script>alert("Có lỗi xảy ra khi thực hiện truy vấn");</script>';
      }
    }

    //Kiểm tra tìm kiếm
    if(isset($_REQUEST["searchForm"])){

      $form = $_REQUEST["searchForm"];

      $bomon = new Bomon();
      $bomons = $bomon->TimKiem($form['maBoMon'], $form['tenBoMon']);
    }
    else{
      //lay danh sach bo mon
      $bomon = new Bomon();
      $bomons = $bomon->getALL();
    }

    $name = "bộ môn";
    $khoa = new Khoa();
    $khoas = $khoa->getALL();
?>
<section id="packageApp" ng-app="packageApp" ng-controller="packageController">
    <section class="vbox">
        <section class="scrollable no-padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in padder bg-primary">
                <li><a href="<%=request.getContextPath()%>/"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                <li><a href="javascript:void(0)">Quản lý <?php echo $name; ?></a></li>
                <li><a href="javascript:void(0)">Danh sách <?php echo $name; ?></a></li>
            </ul>
            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="javascript:void(0)">
                        <h4 class="panel-title font-bold">
                            THÔNG TIN TÌM KIẾM
                        </h4>
                    </a>
                </header>
                <div class="panel-body">
                    <form method="post" Class="form-horizontal" role="form" theme="simple">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Mã <?php echo $name; ?>: </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="searchForm[maBoMon]" type="text" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Tên <?php echo $name; ?>: </label>
                                </div>
                                <div class="col-md-8">
                                    <input name="searchForm[tenBoMon]" type="text" class="form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%; text-align: center">
                            <button type="sumit" class="btn btn-info">Tìm kiếm</button>
                            <a href="index.php?controller=<?php echo $_REQUEST['controller'];?>&action=index" class="btn btn-default" >Xóa điều kiện</a>
                            <a data-target="#addPackageForm" class="btn btn-primary" data-toggle="modal">Thêm mới</a>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="clear:both ;border-top:0px"></div>

                    </form>
                </div>

            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="javascript:void(0)">
                        <h4 class="panel-title font-bold text-uppercase" data-toggle="collapse">
                            Danh sách <?php echo $name; ?>
                        </h4>
                    </a>
                </header>
                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body background-xam">
                        <!-- <div class="row padding" style="padding-top: 0px;">
                            <label class="input-sm">Tổng số bản ghi: </label>
                            <label style="color: red;"></label>
                            <label class="input-sm">Hiển thị: </label>
                            <select class="input-sm form-control input-s-sm inline" style="width: 60px;" ng-model="numberPerPage" ng-change="setNumberPerPage(numberPerPage);" ng-init="numberPerPage = '25'">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select>
                        </div> -->

                        <div class="table-responsive bg-white">
                            <table class="table b-t b-light table-bordered table-hover" style="margin-bottom: 0px;">
                                <thead class="bg-gray">
                                <tr>
                                    <th class="text-center v-inherit text-dark">Mã <?php echo $name; ?></th>
                                    <th class="text-center v-inherit text-dark">Tên <?php echo $name; ?></th>
                                    <th class="text-center v-inherit text-dark">Tên khóa</th>
                                    <th class="text-center v-inherit text-dark">Mô tả</th>
                                    <th class="text-center v-inherit text-dark">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($bomons as $val){
                                        echo 
                                        '<tr>
                                            <td class="text-left v-inherit">'.$val["maBoMon"].'</td>
                                            <td class="text-left v-inherit">'.$val["tenBoMon"].'</td>
                                            <td class="text-left v-inherit">'.$val["tenKhoa"].'</td>
                                            <td class="text-left v-inherit">'.$val["moTa"].'</td>
                                            <td class="text-center v-inherit">
                                              <a href="javascript:void(0)" data-toggle="modal" data-target="#editPackageForm'.$val["maBoMon"].'">
                                                Sửa
                                              </a>
                                              /
                                              <a class="deleteButton" href="javascript:void(0)" data-toggle="modal" data-target="#deletePackage" val-target="'.$val["maBoMon"].'">
                                                Xóa 
                                              </a>
                                            </td>
                                        </tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- <footer class="panel-footer">
                            <div class="row">
                                <div class="p-r-0 col-sm-12 text-right text-center-xs">
                                    <ul class="pagination pagination-sm m-t-none m-b-none">
                                        <li><a href="javascript:void(0)">«</a></li>
                                        <li>
                                            <a href="javascript:void(0)" > {{item}}</a>
                                            <a href="javascript:void(0)" > {{item}}</a>
                                        </li>
                                        <li><a href="javascript:void(0)" >»</a></li>
                                    </ul>
                                </div>
                            </div>
                        </footer> -->
                    </div>
                </div>
            </section>
        </section>
    </section>
<!--    <%--    confirm delete package--%>-->
    <div class="modal fade" id="deletePackage" tabindex="-1" role="dialog" aria-labelledby="deletePackage" aria-hidden="true" aria-label="Close">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-info">
                    <button type="button" class="close" class="btn btn-default" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Xác nhận</h4>
                </div>
                <div style="width: 30%; float: left; text-align: center;">
                    <img src="<%=request.getContextPath()%>/assets/images/q.png" >
                </div>
                <div>
                    <div class="modal-body">
                        <label>Bạn có chắc chắn muốn xóa <?php echo $name; ?> </label>
                        <span> hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <form name="deleteForm" action="" method="post">
                          <input style="display: none;" class="in-val-target" type="text" name="deleteForm[maBoMon]" value="">
                          <button type="submit" class="btn btn-primary" style="text-transform: none;"><i class="fa fa-check"></i> Đồng ý</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Hủy bỏ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <%--    end confirm delete package--%>-->
<!--    <%--    form--%>-->
    <div class="modal fade"  id="addPackageForm"  role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width: 60%">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header alert " style="padding: 7px; background: #277CBE;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="myModalLable" style="font-size: 14pt;color: White;">Thêm mới <?php echo $name; ?></h5>
                    </div>
                    <div class="modal-body row"  style="padding: 10px;">
                        <div class="col-md-2">Khoa(<font color="red">*</font>)</div>
                        <div class="col-md-3">
                            <select name="addForm[maKhoa]" class="form-control" >
                                <!-- <option value="">--Lựa chọn--</option> -->
                                <?php 
                                    foreach($khoas as $val){
                                        echo '<option value="'.$val['maKhoa'].'">'.$val['tenKhoa'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">Mã bộ môn(<font color="red">*</font>)</div>
                        <div class="col-md-3">
                            <input class="form-control" name="addForm[maBoMon]" type="text" placeholder="Mã bộ môn..." maxlength="50" >
                        </div>
                        <div class="col-md-2">Tên bộ môn(<font color="red">*</font>)</div>
                        <div class="col-md-10">
                            <input class="form-control" name="addForm[tenBoMon]" type="text" placeholder="Tên bộ môn..." maxlength="50" >
                        </div>

                    </div>
                    <div class="modal-body row"  style="padding: 10px;">
                        <div class="col-md-2">Chi tiết bộ môn(<font color="red">*</font>)</div>
                        <div class="col-md-10">
                            <textarea name="addForm[moTa]"  class="form-control input-sm"></textarea>
                        </div>
                    </div>
                    <div style="text-align: center; padding-bottom: 30px; padding-top: 30px">
                        <button type="submit" id="btnSave" class="btn btn-primary" style="width: 100px">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!--    <%--    end form add--%>-->

<?php 
  foreach($bomons as $val){
    echo '<div class="modal fade" id="editPackageForm'.$val['maBoMon'].'"  role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 60%">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header alert " style="padding: 7px; background: #277CBE;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLable'.$val['maBoMon'].'" style="font-size: 14pt;color: White;">Sửa thông tin '.$name.' '.$val['maBoMon'].'</h5>
                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Khoa(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                    <select name="editForm[maKhoa]" class="form-control" >
                    <!-- <option value="">--Lựa chọn--</option> -->';
                    foreach($khoas as $khoa){
                      if($khoa['maKhoa'] == $val['maKhoa']){
                        echo '<option selected value="'.$khoa['maKhoa'].'">'.$khoa['tenKhoa'].'</option>';
                      }
                      else {
                        echo '<option value="'.$khoa['maKhoa'].'">'.$khoa['tenKhoa'].'</option>';
                      }
                    }
                    echo '
                    </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Mã bộ môn(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <input class="form-control" name="editForm[maBoMon]" type="text" placeholder="Mã bộ môn..." maxlength="50" value="'.$val['maBoMon'].'">
                    </div>
                    <div class="col-md-2">Tên bộ môn(<font color="red">*</font>)</div>
                    <div class="col-md-10">
                        <input class="form-control" name="editForm[tenBoMon]" type="text" placeholder="Tên bộ môn..." maxlength="50" value="'.$val['tenBoMon'].'">
                    </div>

                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Chi tiết bộ môn(<font color="red">*</font>)</div>
                    <div class="col-md-10">
                        <textarea name="editForm[moTa]"  class="form-control input-sm">'.$val['moTa'].'</textarea>
                    </div>
                </div>
                <div style="text-align: center; padding-bottom: 30px; padding-top: 30px">
                    <button type="submit" id="btnSave" class="btn btn-primary" style="width: 100px">Lưu</button>
                </div>
            </div>
        </form>
      </div>
    </div>';
  }
?>

</section>
