
var app = angular.module('packageApp', []);
app.config(['$provide', function($provide) {
    $provide.decorator('$locale', ['$delegate', function($delegate) {
        $delegate.NUMBER_FORMATS.DECIMAL_SEP = ',';
        $delegate.NUMBER_FORMATS.GROUP_SEP = '.';
        return $delegate;
    }]);
}])
app.controller('packageController', ['$scope', '$http', '$timeout', '$q', function ($scope, $http, $timeout, $q) {
    $scope.numberPerPage = 10;
    $scope.pageNumber=1;
    $scope.maMon="";
    $scope.thu={2:'Thứ 2',3:'Thứ 3',4:'Thứ 4',5:'Thứ 5',6:'Thứ 6',7:'Thứ 7'};
    $scope.maGiaoVien="";
    $scope.itemAdd={maMon:'',maGiaoVien:'',thoiGian:'',soTiet:'',ghiChu:'',diaDiem:''};

    $http.get("index.php?controller=lichgiangday&action=getAll",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
            maMon:$scope.maMon,maGiaoVien:$scope.maGiaoVien}})
        .then(function (response) {

            $scope.listData = response.data;



        });
    $scope.search= function () {
        $http.get("index.php?controller=lichgiangday&action=getAll",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
                maMon:$scope.maMon,maGiaoVien:$scope.maGiaoVien}})
            .then(function (response) {

                $scope.listData = response.data;


            });
    }
    $scope.resetValue=function () {
        $scope.maMon="";
        $scope.maGiaoVien="";
        $scope.search();
    }
    $scope.loadPageData=function (item) {
        $scope.pageNumber=item;
        $scope.search();
    }
    $scope.save=function (itemAdd) {

        let i=$scope.check();

        if (i) {

            itemAdd =JSON.parse(JSON.stringify($scope.itemAdd));
            $.post(
                'index.php?controller=Lichgiangday&action=add', // URL
                itemAdd,
                function (response) {

                    number = Number(response);
                    switch (number) {
                        case 1:

                            $("#addPackageForm").modal("hide");
                            toastr.success("Thêm mới Lịch giảng dạy thành công");
                            $scope.clearForm();
                            $scope.search();
                            break;

                        case 0:

                            toastr.error("Có lỗi trong quá trình xử lý vui lòng thử lại");
                            $scope.search();
                            break;

                    }
                },
                'text'
            );
        }


    }
    $scope.clearForm=function () {
        $scope.itemAdd={maMon:'',maGiaoVien:'',thoiGian:'',soTiet:'',ghiChu:'',diaDiem:''};
    }
    $scope.check=function () {
        const regex = new RegExp('^[1-9]{1,4}$')
        if($scope.itemAdd.maMon==""||$scope.itemAdd.maMon==null)
        {

            toastr.error("Hãy chọn môn học");
            return false
        }
        if($scope.itemAdd.maGiaoVien==""||$scope.itemAdd.maGiaoVien==null)
        {

            toastr.error("Hãy chọn Giáo viên");
            return false
        }
        if ($scope.itemAdd.soTiet==""||regex.test($scope.itemAdd.soTiet)==false)
        {
            toastr.error("Số tiết chưa đúng định dạng");
            return false
        }
        if($scope.itemAdd.diaDiem=="")
        {

            toastr.error("Hãy chọn thời gian");
            return false
        }
        if($scope.itemAdd.ghiChu==""||$scope.itemAdd.ghiChu==null)
        {

            toastr.error("Hãy nhập ghi chú");
            return false
        }
        if($scope.itemAdd.diaDiem==""||$scope.itemAdd.diaDiem==null)
        {

            toastr.error("Hãy nhập Địa điểm");
            return false
        }
        if($scope.itemAdd.thoiGian==""||regex.test($scope.itemAdd.thoiGian)==false)
        {

            toastr.error("Hãy chọn thời gian");
            return false
        }
        return true;
    }
    $scope.checkEdit=function () {
        const regex = new RegExp('^[1-9]{1,4}$')
        if($scope.itemFix.maMon==""||$scope.itemFix.maMon==null)
        {

            toastr.error("Hãy chọn môn học");
            return false
        }
        if($scope.itemFix.maGiaoVien==""||$scope.itemFix.maGiaoVien==null)
        {

            toastr.error("Hãy chọn Giáo viên");
            return false
        }
        if ($scope.itemFix.soTiet==""||regex.test($scope.itemFix.soTiet)==false)
        {
            toastr.error("Số tiết chưa đúng định dạng");
            return false
        }
        if($scope.itemFix.diaDiem=="")
        {

            toastr.error("Hãy chọn thời gian");
            return false
        }
        if($scope.itemFix.ghiChu==""||$scope.itemFix.ghiChu==null)
        {

            toastr.error("Hãy nhập ghi chú");
            return false
        }
        if($scope.itemFix.diaDiem==""||$scope.itemFix.diaDiem==null)
        {

            toastr.error("Hãy nhập Địa điểm");
            return false
        }
        if($scope.itemFix.thoiGian==""||regex.test($scope.itemFix.thoiGian)==false)
        {

            toastr.error("Hãy chọn thời gian");
            return false
        }
        return true;

    }
    $scope.edit=function (item2) {
        $scope.itemTemp=item2;

        $scope.itemFix={maMon:Number(item2.maMon),maGiaoVien:Number(item2.maGiaoVien),thoiGian:Number(item2.thoiGian),ghiChu:item2.ghiChu,diaDiem:item2.diaDiem,soTiet:item2.soTiet}

    }
    $scope.clearFormFix= function()
    {

       $scope.itemFix={maMon:Number($scope.itemTemp.maMon),maGiaoVien:Number($scope.itemTemp.maGiaoVien),thoiGian:Number($scope.itemTemp.thoiGian),ghiChu:$scope.itemTemp.ghiChu,diaDiem:$scope.itemTemp.diaDiem,soTiet:$scope.itemTemp.soTiet}

    }
    $scope.fix=function () {
        let i = $scope.checkEdit();

        if (i) {

            itemFix = JSON.parse(JSON.stringify($scope.itemFix));
            $.post(
                'index.php?controller=Lichgiangday&action=update', // URL
                itemFix,
                function (response) {

                    number = Number(response);
                    switch (number) {
                        case 1:

                            $("#fix").modal("hide");
                            $scope.clearForm();
                            toastr.success("Sửa Lịch giảng dạy thành công");
                            $scope.search();
                            break;

                        case 0:

                            toastr.error("Có lỗi trong quá trình xử lý vui lòng thử lại");
                            $scope.search();
                            break;

                    }
                },
                'text'
            );
        }
    }
    $scope.delete=function (itemDelete) {
       $scope.maMonDelete=itemDelete.maMon;
       $scope.maGiaoVienDelete=itemDelete.maGiaoVien;
    }
    $scope.deleteYes=function () {
        $.post(
            'index.php?controller=lichgiangday&action=delete', // URL
            {maMon:$scope.maMonDelete,maGiaoVien:$scope.maGiaoVienDelete},  // Data
            function (response) {

                number = Number(response);
                switch (number) {
                    case 1:

                        $("#deletePackage").modal("hide");
                        $scope.clearForm();
                        toastr.success("Xóa thành công Lịch giảng dạy");
                        $scope.search();
                        break;

                    case 0:

                        toastr.error("Có lỗi trong quá trình xử lý vui lòng thử lại");
                        $scope.search();
                        break;

                }
            },
            'text'
        );
    }

}]);