<?php
    //lay danh sach mon
    $mon =new Mon();
    $mons = $mon->getALL(1,25) ;
?>
<section id="packageApp" ng-app="packageApp" ng-controller="packageController">
    <section class="vbox">
        <section class="scrollable no-padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in padder bg-primary">
                <li><a href="<%=request.getContextPath()%>/"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                <li><a href="javascript:void(0)">Quản lý môn học</a></li>
                <li><a href="javascript:void(0)">Danh sách môn học</a></li>
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
                    <form Class="form-horizontal" role="form" theme="simple">
                        <div class="row" style="margin-top: 10px;">
<!--                            <%--   select status--%>-->
                            <div class="col-sm-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Trạng thái:</label>
                                </div>
                                <div class="col-md-8">
                                    <select ng-model="status" id="status" class="form-control">
                                        <option value="">Tất cả</option>
                                        <option ng-value="1">Hiển thị</option>
                                        <option ng-value="0">Không hiển thị</option>

                                    </select>
                                </div>
                            </div>
<!--                            <%-- select package type--%>-->
                            <div class="col-sm-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Loại môn:</label>
                                </div>
                                <div class="col-md-8">
                                    <select ng-model="packageType" id="packageType" class="form-control" >
                                        <option value="" disabled style="display: none">Tất cả</option>
                                        <option ng-value="1">Gói hot</option>
                                        <option ng-value="2">Trả Sau</option>
                                        <option ng-value="3">Trả Trước</option>
                                        <option ng-value="4">Data</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Tên môn: </label>
                                </div>
                                <div class="col-md-8">
                                    <input id="packageName" name="PackageName" type="text" class="form-control input-sm" ng-model="packageName" pattern="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Đầu Số: </label>
                                </div>
                                <div class="col-md-8">
                                    <input id="packNumber" name="packNumber" type="number" class="form-control input-sm" ng-model="packageNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row expandSearch hide" style="margin-top: 10px;" >
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Giá môn(VNĐ): </label>
                                </div>
                                <div class="col-md-8">
                                    <input id="fromPrice" name="fromPrice" type="number" class="form-control input-sm" placeholder="Từ" min="0" ng-model="fromPrice">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <input id="toPrice" name="toPrice" type="number" class="form-control input-sm" placeholder="Đến" min="0" ng-model="toPrice" >
                                </div>
                            </div>
                        </div>
                        <div class="row expandSearch hide" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Chu Kỳ:</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="fromDate" type="number" class="form-control input-sm" placeholder="Từ" ng-model="fromDate" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <input name="toDate" type="number" class="form-control input-sm"  placeholder="Đến" ng-model="toDate" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 2%; text-align: center">
                            <a ng-click="search()" class="btn btn-info">Tìm kiếm</a>
                            <a ng-click="resetValue()" class="btn btn-default" >Xóa điều kiện</a>
                                <a data-target="#addPackageForm" class="btn btn-primary" data-toggle="modal" ng-click="preSavePackage()">Thêm mới</a>
                            <div  id="hide" style="font-size: 15px; color: #0761AF; font-weight: 300; text-decoration: underline; width: 100%; padding: 0px 0px 0px 80%;  " class="hide">Thu gọn tìm kiếm</div>
                            <div  id="unHide" style="font-size: 15px; color : #0761AF;font-weight:300; text-decoration: underline; width: 100%; padding: 0px 0px 0px 80%; ">Tìm kiếm nâng cao</div>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="clear:both ;border-top:0px"></div>

                    </form>
                </div>

            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="javascript:void(0)">
                        <h4 class="panel-title font-bold text-uppercase" data-toggle="collapse">
                            DANH SÁCH môn
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
                                    <th class="text-center v-inherit text-dark">Mã môn</th>
                                    <th class="text-center v-inherit text-dark">Thao tác</th>
                                    <th class="text-center v-inherit text-dark">Tên môn</th>
                                    <th class="text-center v-inherit text-dark">Tên Bộ môn</th>
                                    <th class="text-center v-inherit text-dark">Mô tả </th>
                                    <th class="text-center v-inherit text-dark" >Ngày Tạo</th>
                                    <th class="text-center v-inherit text-dark" >Ngày Cập Nhật</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($mons as $mon){
                                        echo 
                                        '<tr>
                                            <td class="text-left v-inherit">'.$mon["maMon"].'</td>
                                            <td class="text-center v-inherit">
                                                <div class="btn-group">
                                                    <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cogs"></i></button>
                                                    <ul class="dropdown-menu pull-left" style="width: fit-content;">
                                                        <li ><a href="javascript:void(0)" data-toggle="modal" ng-click="preEditPackage(item);" data-target="#addPackageForm"><font style="font-weight: bold;">
                                                                    <i class="fa fa-eye icon"></i> Thông tin môn
                                                                </font></a></li>
                                                        <li ><a href="javascript:void(0)" data-toggle="modal"  ng-click="preAddPackage(item);" data-target="#addPackageForm"><font style="font-weight: bold;">
                                                                    <i class="fa fa-copy icon"></i> Nhân bản thông tin môn
                                                                </font></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="text-left v-inherit">'.$mon["tenMon"].'</td>
                                            <td class="text-left v-inherit">'.$mon["tenMon"].'</td>
                                            <td class="text-left v-inherit">'.$mon["moTa"].'</td>
                                            <td class="text-left v-inherit">'.$mon["taoNgay"].'</td>
                                            <td class="text-left v-inherit">'.$mon["suaNgay"].'</td>
                                        </tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <footer class="panel-footer">
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
                        </footer>
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
                        <label>Bạn có chắc chắn muốn xóa môn </label>
                        <span>{{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="deletePackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đồng ý</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <%--    end confirm delete package--%>-->
<!--    <%--    confirm unlock package--%>-->
    <div class="modal fade" id="unlockPackage" tabindex="-1" role="dialog"
         aria-labelledby="unlockPackage" aria-hidden="true" aria-label="Close">
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
                        <label>Bạn có chắc chắn muốn hiển thị môn </label>
                        <span> {{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="unlockPackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đồng ý</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <%--   end confirm unlock  package--%>-->
<!--    <%--    confirm lock package--%>-->
    <div class="modal fade" id="lockPackage" tabindex="-1" role="dialog"
         aria-labelledby="lockPackage" aria-hidden="true" aria-label="Close">
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
                        <label>Bạn có chắc chắn muốn tắt hiển thị môn  </label>
                        <span>{{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="lockPackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đồng ý</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <%--   end confirm lock  package--%>-->
<!--    <%--    form--%>-->
    <div class="modal fade"  id="addPackageForm"  role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width: 60%">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header alert " style="padding: 7px; background: #277CBE;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="myModalLable" style="font-size: 14pt;color: White;">Thêm mới môn học</h5>
                    </div>
                    <div class="modal-body row"  style="padding: 10px;">
                        <div class="col-md-2">Bộ môn(<font color="red">*</font>)</div>
                        <div class="col-md-3">
                            <select name="maBoMon" class="form-control" >
                                <option value=""  disabled style="display:none">--Lựa chọn--</option>
                                <?php 
                                    // foreach($bomons as $bomon){
                                    //     echo '<option value="'.$bomon['id'].'">'.$bomon['tenBomon'].'</option>'
                                    // }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">Tên môn(<font color="red">*</font>)</div>
                        <div class="col-md-3">
                            <input class="form-control" name="tenMon" type="text" placeholder="Tên môn..." maxlength="50" >
                        </div>

                    </div>
                    <div class="modal-body row"  style="padding: 10px;">
                        <div class="col-md-2">Chi tiết môn(<font color="red">*</font>)</div>
                        <div class="col-md-10">
                            <textarea  class="form-control input-sm"  ng-model="packageAdd.packDetail" maxlength="200"></textarea>

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


</section>
