<script src="assets/js/mon/mon.js"></script>
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
                                    <label class="control-label color-label">Loại gói cước:</label>
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
                                    <label class="control-label color-label">Tên Gói Cước: </label>
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
                                    <label class="control-label color-label">Giá gói cước(VNĐ): </label>
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
                            DANH SÁCH GÓI CƯỚC
                        </h4>
                    </a>
                </header>
                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body background-xam">
                        <div class="row padding" style="padding-top: 0px;">
                            <label class="input-sm">Tổng số bản ghi: </label>
                            <label style="color: red;">{{listData.rowCount}}</label>
                            <label class="input-sm">Hiển thị: </label>
                            <select class="input-sm form-control input-s-sm inline" style="width: 60px;" ng-model="numberPerPage" ng-change="setNumberPerPage(numberPerPage);" ng-init="numberPerPage = '25'">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select>
                            <button type="button"  class="pull-right btn btn-s-sm btn-info" ng-click="exportExcelPackages()"><i class="fa fa-file-excel-o" ></i> Xuất excel</button>
                        </div>

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
                                <tr ng-repeat="item in listData.items">
                                    <td class="text-center v-inherit" >{{}}</td>
                                    <td class="text-center v-inherit">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cogs"></i></button>
                                            <ul class="dropdown-menu pull-left" style="width: fit-content;">
                                                <li ><a href="javascript:void(0)" data-toggle="modal" ng-click="preEditPackage(item);" data-target="#addPackageForm"><font style="font-weight: bold;">
                                                            <i class="fa fa-eye icon"></i> Thông tin gói cước
                                                        </font></a></li>
                                                <li ><a href="javascript:void(0)" data-toggle="modal"  ng-click="preAddPackage(item);" data-target="#addPackageForm"><font style="font-weight: bold;">
                                                            <i class="fa fa-copy icon"></i> Nhân bản thông tin gói cước
                                                        </font></a></li>
                                                <li ><a href="javascript:void(0)" data-toggle="modal" data-target="#deletePackage" ng-click="deletePackage(item);"><font style="font-weight: bold;">
                                                            <i class="fa fa-trash icon"></i> Xóa
                                                        </font></a></li>
                                                <li ng-if="item.status==0"><a href="" data-toggle="modal" data-target="#unlockPackage" ng-click="unlockPackage(item);"><font style="font-weight: bold;">
                                                            <i class="fa fa-unlock icon"></i> Bật thông tin gói cước
                                                        </font></a></li>
                                                <li ng-if="item.status==1"><a href="" data-toggle="modal" data-target="#lockPackage" ng-click="lockPackage(item);"><font style="font-weight: bold;">
                                                            <i class="fa fa-lock icon"></i> Tắt thông tin gói cước
                                                        </font></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-left v-inherit {{item.status == 1 ? 'text-info':'text-danger'}}">{{item.status == 1 ? 'Hiển thị':'Không hiển thị'}}</td>
                                    <td class="text-left v-inherit">{{item.type ==1 ?'Gói hot':(item.type==2?'Trả sau':(item.type==3?'Trả trước':'Data'))}}</td>
                                    <td class="text-left v-inherit">{{item.pckCode}}</td>
                                    <td class="text-left v-inherit">{{item.packNumber}}</td>
                                    <td class="text-left v-inherit">{{item.amount|currency:"":0}}</td>
                                    <td class="text-left v-inherit">{{item.numExpired}} ngày</td>
                                    <td class="text-left v-inherit">{{item.createBy}}</td>
                                    <td class="text-left v-inherit">{{item.genDate|date:'dd-MM-yyyy HH:mm:ss'}}</td>
                                    <td class="text-left v-inherit">{{item.lastUpdated|date:'dd-MM-yyyy HH:mm:ss'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <footer class="panel-footer">
                            <div class="row">
                                <div class="p-r-0 col-sm-12 text-right text-center-xs">
                                    <ul class="pagination pagination-sm m-t-none m-b-none">
                                        <li ng-if="listData.pageNumber > 1"><a href="javascript:void(0)" ng-click="loadPageData(1)">«</a></li>
                                        <li ng-repeat="item in listData.pageList">
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
                        <label>Bạn có chắc chắn muốn xóa gói cước </label>
                        <span>{{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="deletePackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đống ý</button>
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
                        <label>Bạn có chắc chắn muốn hiển thị gói cước </label>
                        <span> {{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="unlockPackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đống ý</button>
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
                        <label>Bạn có chắc chắn muốn tắt hiển thị gói cước  </label>
                        <span>{{namePackNeeded}} hay không?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="lockPackageYes()" style="text-transform: none;"><i class="fa fa-check"></i>Đống ý</button>
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
            <div class="modal-content">
                <div class="modal-header alert " style="padding: 7px; background: #277CBE;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="clearForm()">&times;</button>
                    <h5 class="modal-title" id="myModalLable" ng-if="titleForm=='ADD'" style="font-size: 14pt;color: White;">Thêm mới gói cước</h5>
                    <h5 class="modal-title" id="myModalLable" ng-if="titleForm=='EDIT'" style="font-size: 14pt; color: White;">Thông tin gói cước</h5>
                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Loại Gói Cước(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <select ng-model="packageAdd.type" class="form-control" >
                            <option value=""  disabled style="display:none">--Lựa chọn--</option>
                            <option ng-value="1">Gói Hot</option>
                            <option ng-value="2">Trả sau</option>
                            <option ng-value="3">Trả trước</option>
                            <option ng-value="4">Data</option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Tên gói cước(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" placeholder="Tên gói cước..." ng-model="packageAdd.pckCode" maxlength="50" >
                    </div>

                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Đầu Số(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <input  type="text"
                                class="form-control input-sm currencyHtml"  ng-model="packageAdd.packNumber" maxlength="10">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Trạng thái(<font color="red">*</font>)</div>
                    <div class="col-md-3">
                        <select ng-model="packageAdd.status" class="form-control" >
                            <option ng-value="1" ng-selected="selected" >Hiển thị</option>
                            <option ng-value="0">Không hiển thị</option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>

                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Giá gói cước(<font color="red">*</font>)</div>
                    <div class="col-md-3" style="padding-right: 1px">
                        <input  type="number"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                class="a form-control input-sm currencyHtml" min="0" ng-model="packageAdd.amount" maxlength="15"

                        >
                    </div>
                    <i style="font-size: 10px; padding:10px 0;" class="col-md-1">(VNĐ)</i>
                    <div class="col-md-2">Chu Kỳ(<font color="red">*</font>)</div>
                    <div class="col-md-3" style="padding-right: 1px">
                        <input  type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control input-sm " min="0" ng-model="packageAdd.numExpired" maxlength="10">
                    </div>
                    <i style="font-size: 10px; padding:10px 0;" class="col-md-1">(Ngày)</i>
                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Chi tiết gói cước(<font color="red">*</font>)</div>
                    <div class="col-md-10">
                        <textarea  class="form-control input-sm"  ng-model="packageAdd.packDetail" maxlength="200"></textarea>

                    </div>
                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Tỷ lệ HH OSP nhận được từ MBF(<font color="red">*</font>)</div>
                    <div class="col-md-3" style="padding-right: 1px">
                        <input  type="number"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                class="form-control input-sm" min="0"
                                ng-model="packageAdd.ratio"
                                maxlength="5"
                        >

                    </div>
                    <i style="font-size: 10px; padding:10px 0;" class="col-md-1">(%)    (Đã có VAT)</i>

                    <div class="col-md-2">HH gói cước OSP nhận được từ MBF </div>
                    <div class="col-md-3" style="padding-right: 1px">
                        <input  type="text" class="form-control input-sm " min="0" step="1" value="{{caculator(packageAdd.amount,packageAdd.ratio)|number:0}}" id="osp"  disabled >


                    </div>
                    <div class="text-muted">
                        <i style="font-size: 10px;">(VNĐ)</i>
                        <span data-toggle="tooltip" data-placement="top"
                              title="HH gói cước OSP nhận được từ MBF (Chưa VAT) =(Giá gói cước / 110%) * Tỷ lệ) " style="color: red; display: inline">

                             <i class="fa fa-question icon"></i>
                    </span><i style="font-size: 10px;">(Chưa VAT)</i></div>

                </div>
                <div class="modal-body row"  style="padding: 10px;">

                </div>
                <div class="modal-body row"  style="padding: 10px;">
                    <div class="col-md-2">Giới thiệu gói cước</div>
                </div>
                <div >
                    <textarea  ng-model="packageAdd.note" id="editor"></textarea>
                </div>


                <div style="text-align: center; padding-bottom: 30px; padding-top: 30px">
                    <button class="btn btn-default" style="width: 100px" ng-click="clearFormDuplicate()" ng-if="resetTitle=='DUPLICATE'" >Làm mới</button>
                    <button class="btn btn-default" style="width: 100px" ng-click="clearForm()" ng-if="resetTitle=='ADD'" >Làm mới</button>
                    <button type="button" id="btnSave" ng-if="titleForm=='ADD'"  class="btn btn-primary" style="width: 100px" ng-click="savePackage(packageAdd)">Lưu</button>
                    <button type="button" id="btnSave" ng-if="titleForm=='EDIT'"  class="btn btn-primary" style="width: 100px" ng-click="editPackage(packageAdd)">sửa</button>
                    <button class="btn btn-danger" style="width: 100px" ng-click="clearForm()" data-dismiss="modal" >Quay lại</button>
                </div>


            </div>
        </div>
    </div>
<!--    <%--    end form add--%>-->


</section>
