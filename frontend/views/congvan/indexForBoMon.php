<script src="assets/js/congvan/congvan1.js"></script>
<section id="packageApp" ng-app="packageApp" ng-controller="packageController">
    <section class="vbox">
        <section class="scrollable no-padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in padder bg-primary">
                <li><a href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                <li><a href="javascript:void(0)">Quản lý công văn</a></li>
                <li><a href="javascript:void(0)">Danh sách công văn của bộ môn</a></li>
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

                            <div class="col-sm-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Trạng thái:</label>
                                </div>
                                <div class="col-md-8">
                                    <select ng-model="status" id="status" class="form-control">
                                        <option ng-value="0" selected>đã đọc</option>
                                        <option ng-value="1">chưa đọc</option>

                                    </select>
                                </div>
                            </div>
                            <!--                            <%-- select package type--%>-->
                            <div class="col-sm-6">
                                <div class="col-md-4">
                                    <label class="control-label color-label">Tên :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" ng-model="tenCongVan" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-top: 2%; text-align: center">
                            <a ng-click="search()" class="btn btn-info">Tìm kiếm</a>
                            <a ng-click="resetValue()" class="btn btn-default" >Xóa điều kiện</a>

                        </div>
                        <div class="line line-dashed line-lg pull-in" style="clear:both ;border-top:0px"></div>

                    </form>
                </div>

            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="javascript:void(0)">
                        <h4 class="panel-title font-bold text-uppercase " data-toggle="collapse">
                            DANH SÁCH CÔNG VĂN
                        </h4>
                    </a>
                </header>
                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body background-xam">
                        <div class="row padding" style="padding-top: 0px;">
                            <label class="input-sm">Tổng số bản ghi: </label>
                            <label style="color: red;">{{listData.rowCount}}</label>
                            <label class="input-sm">Hiển thị: 10 </label>


                        </div>

                        <div class="table bg-white">
                            <table class="table b-t b-light table-bordered table-hover" style="margin-bottom: 0px;">
                                <thead class="bg-gray">
                                <tr>
                                    <th class="text-center v-inherit text-dark">Mã công văn</th>
                                    <th class="text-center v-inherit text-dark">Thao tác</th>
                                    <th class="text-center v-inherit text-dark">Tên công văn</th>
                                    <th class="text-center v-inherit text-dark">Mô tả </th>
                                    <th class="text-center v-inherit text-dark" >Ngày Tạo</th>
                                    <th class="text-center v-inherit text-dark" >Ngày Cập Nhật</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="item in listData.items">
                                    <td class="text-center v-inherit" >{{item.maCongVan}}</td>
                                    <td class="text-center v-inherit">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cogs"></i></button>
                                            <ul class="dropdown-menu pull-left" style="width: fit-content;">
                                                <li ><a href="javascript:void(0)" data-toggle="modal" ng-click="edit(item);" data-target="#fix"><font style="font-weight: bold;">
                                                            <i class="fa fa-eye icon"></i> Chi tiết công văn
                                                        </font></a></li>



                                            </ul>
                                        </div>
                                    </td>

                                    <td class="text-left v-inherit">{{item.tenCongVan}}</td>
                                    <td class="text-left v-inherit">{{item.noiDung}}</td>

                                    <td class="text-left v-inherit">{{item.taoNgay|date:'dd-MM-yyyy HH:mm:ss'}}</td>
                                    <td class="text-left v-inherit">{{item.suaNgay|date:'dd-MM-yyyy HH:mm:ss'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <footer class="panel-footer">
                            <div class="row">
                                <div class="p-r-0 col-sm-12 text-right text-center-xs">
                                    <ul class="pagination pagination-sm m-t-none m-b-none">
                                        <li ng-if="listData.pageNumber > 1"><a href="javascript:void(0)" ng-click="loadPageData(1)">«</a></li>
                                        <li ng-repeat="item in listData.pages  track by $index">

                                            <a href="javascript:void(0)" ng-if="item == listData.pageNumber" style="color:mediumvioletred;"> {{item}}</a>
                                            <a href="javascript:void(0)" ng-if="item != listData.pageNumber" ng-click="loadPageData(item)"> {{item}}</a>
                                        </li>
                                        <li ng-if="listData.pageNumber < listData.pageCount"><a href="javascript:void(0)" ng-click="loadPageData(listData.pageCount)">»</a></li>
                                    </ul>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <div class="modal fade"  id="fix"  role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header alert text-center " style="padding: 7px; background: #277CBE;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="clearForm()">&times;</button>
                    <h5 class="modal-title" id="myModalLable" style="font-size: 14pt;color: White;">Chi tiết công văn</h5>
                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Bộ môn(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <select ng-model="itemFix.maBoMon" class="form-control" disabled >
                            <option value=""  >--Không chọn--</option>
                            <option ng-repeat="item in listData.items2" ng-value="{{item.maBoMon}}">{{item.tenBoMon}}</option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Tên công văn(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" placeholder="Tên công văn..." ng-model="itemFix.tenCongVan" maxlength="50" disabled >
                    </div>

                </div>



                <div class="modal-body row"  style="padding: 10px;">



                    <div class="col-md-2">Mô tả(<font color="red">*</font>)</div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" placeholder="Mô tả..." ng-model="itemFix.noiDung" maxlength="50" disabled >
                    </div>

                </div>
                <div class="modal-body row"  style="padding: 10px;">




                    <div class="col-md-2">File công văn(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <a  href="../backend/assets/uploads/{{itemFix.file}}" download>{{itemFix.file}}</a>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Trạng thái(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <select ng-model="itemFix.status" class="form-control" disabled >
                            <option value=""  >--Lựa chọn--</option>
                            <option  ng-value="1">Chưa đọc</option>
                            <option  ng-value="0">Đã đọc</option>
                        </select>
                    </div>

                </div>


                <div style="text-align: center; padding-bottom: 30px; padding-top: 30px">
                    <button type="button" id="btnSave" class="btn btn-primary" ng-if="itemFix.status==1" style="width: 100px" ng-click="fix(itemFix)">Đã đọc</button>
                    <button type="button" id="btnSave" class="btn btn-primary" ng-if="itemFix.status==0" style="width: 200px" ng-click="fix(itemFix)">Đánh dấu chưa đọc</button>
                    <button class="btn btn-danger" style="width: 100px" ng-click="clearFormFix()" data-dismiss="modal" >Quay lại</button>
                </div>


            </div>
        </div>
    </div>

</section>
