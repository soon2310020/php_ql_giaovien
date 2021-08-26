
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
    $scope.maBoMon="";
    $scope.tenCongVan="";
    $scope.maGiaoVien="";
    $scope.status=-1;
    $scope.itemAdd={maBoMon:'',tenCongVan:'',maGiaoVien:'',noiDung:''};

    $http.get("index.php?controller=Congvan&action=getAllForBoMon",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber
           ,tenCongVan:$scope.tenCongVan,status:$scope.status}})
        .then(function (response) {
            $scope.listData = response.data;



        });
    $scope.search= function () {
        $http.get("index.php?controller=Congvan&action=getAllForBoMon",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber
                ,tenCongVan:$scope.tenCongVan,status:$scope.status}})
            .then(function (response) {
                $scope.listData = response.data;

            });
    }
    $scope.resetValue=function () {
        $scope.maBoMon="";
        $scope.tenCongVan="";
        $scope.maGiaoVien="";
        $scope.status=-1;
        $scope.search();
    }
    $scope.loadPageData=function (item) {
        $scope.pageNumber=item;
        $scope.search();
    }


    $scope.edit=function (item2) {
        $scope.itemTemp=item2;

        $scope.itemFix={maBoMon:Number(item2.maBoMon),tenCongVan:item2.tenCongVan,maGiaoVien:Number(item2.maGiaoVien),noiDung:item2.noiDung,
            status:Number(item2.status),file:item2.file};
    }
    $scope.fix=function (itemFix) {
        var form_data = new FormData();

        form_data.append('maCongVan',$scope.itemTemp.maCongVan);
        form_data.append('status',$scope.itemTemp.status);

            $.ajax({
                url: 'index.php?controller=Congvan&action=update',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success:function (response) {

                    number = Number(response);
                    switch (number) {
                        case 1:

                            $("#fix").modal("hide");
                            if ($scope.itemTemp.status==1)
                            toastr.success("Xác nhận đã đọc công văn thành công");
                            else
                                toastr.success("Đã đánh dấu công văn chưa đọc");
                            $scope.search();
                            $scope.itemTemp="";
                            $('#fileFix').val('');
                            break;

                        case 0:

                            toastr.error("Có lỗi trong quá trình xử lý vui lòng thử lại");
                            $scope.search();
                            break;

                    }
                }
            });
        }



}]);