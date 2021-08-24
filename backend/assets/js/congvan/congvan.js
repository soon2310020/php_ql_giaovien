
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
    $scope.itemAdd={maBoMon:'',tenCongVan:'',maGiaoVien:'',noiDung:''};

    $http.get("index.php?controller=Congvan&action=getAll",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
            maBoMon:$scope.maBoMon,tenCongVan:$scope.tenCongVan,maGiaoVien:$scope.maGiaoVien}})
        .then(function (response) {
            $scope.listData = response.data;



        });
    $scope.search= function () {
        $http.get("index.php?controller=Congvan&action=getAll",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
                maBoMon:$scope.maBoMon,tenCongVan:$scope.tenCongVan,maGiaoVien:$scope.maGiaoVien}})
            .then(function (response) {
                $scope.listData = response.data;



            });
    }
    $scope.resetValue=function () {
        $scope.maBoMon="";
        $scope.tenCongVan="";
        $scope.maGiaoVien="";
        $scope.search();
    }
    $scope.loadPageData=function (item) {
        $scope.pageNumber=item;
        $scope.search();
    }
    $scope.save=function (itemAdd) {


        let i=$scope.check();
        var form_data = new FormData();
        form_data.append('file', $scope.fileData);
        form_data.append('tenCongVan',itemAdd.tenCongVan);
        form_data.append('maBoMon',itemAdd.maBoMon);
        form_data.append('maGiaoVien',itemAdd.maGiaoVien);
        form_data.append('noiDung',itemAdd.noiDung);


        if (i) {
            $.ajax({
                url: 'index.php?controller=Congvan&action=add',
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

                            $("#addPackageForm").modal("hide");
                            toastr.success("Thêm mới công văn thành công");
                            $scope.search();
                            break;

                        case 0:

                            toastr.error("Có lỗi trong quá trình xử lý vui lòng thử lại");
                            $scope.search();
                            break;

                    }
                }
            });

        }


    }
    $scope.clearForm=function () {
        $scope.itemAdd={maBoMon:'',tenCongVan:'',maGiaoVien:'',noiDung:''};
        $('#file').val('');
    }
    $scope.check=function () {
        var file_data = $('#file').prop('files')[0];
        if (file_data==null)
        {
            toastr.error("Hãy chọn file ");
            return false
        }
        var dot = file_data.name.lastIndexOf(".");

        var type = file_data.name.substring(dot+1,file_data.name.length);
        var match = ["pdf", "doc", "docx",];
         if (type.toLowerCase()!=match['0']&&type.toLowerCase()!=match['1']&&type.toLowerCase()!=match['2'])
         {
             toastr.error("hãy chọn file có có định dạng doc, docx hoặc pdf");
             return false
         }
        if(($scope.itemAdd.maBoMon==""||$scope.itemAdd.maBoMon==null)&&($scope.itemAdd.maGiaoVien==""||$scope.itemAdd.maGiaoVien==null))
        {

            toastr.error("Hãy chọn bộ môn hoặc giáo viên");
            return false
        }
        if($scope.itemAdd.tenCongVan==""||$scope.itemAdd.tenCongVan==null)
        {

            toastr.error("Hãy nhập tên công văn");
            return false
        }

        if($scope.itemAdd.noiDung==""||$scope.itemAdd.noiDung==null)
        {

            toastr.error("Hãy nhập mô tả");
            return false
        }
        $scope.fileData=file_data;
        return true;
    }
    $scope.checkEdit=function () {

        var file_data = $('#fileFix').prop('files')[0];
        $scope.fileDataFix="";
        if (file_data!=null)
        {

            var dot = file_data.name.lastIndexOf(".");

            var type = file_data.name.substring(dot+1,file_data.name.length);
            var match = ["pdf", "doc", "docx",];
            if (type.toLowerCase()!=match['0']&&type.toLowerCase()!=match['1']&&type.toLowerCase()!=match['2'])
            {
                toastr.error("hãy chọn file có có định dạng doc, docx hoặc pdf");
                return false
            }
            $scope.fileDataFix=file_data;
        }

        if(($scope.itemFix.maBoMon==""||$scope.itemFix.maBoMon==null)&&($scope.itemFix.maGiaoVien==""||$scope.itemFix.maGiaoVien==null))
        {

            toastr.error("Hãy chọn bộ môn hoặc giáo viên");
            return false
        }
        if($scope.itemFix.tenCongVan==""||$scope.itemFix.tenCongVan==null)
        {

            toastr.error("Hãy nhập tên công văn");
            return false
        }

        if($scope.itemFix.noiDung==""||$scope.itemFix.noiDung==null)
        {

            toastr.error("Hãy nhập mô tả");
            return false
        }

        return true;
    }
    $scope.edit=function (item2) {
        $scope.itemTemp=item2;

        $scope.itemFix={maBoMon:Number(item2.maBoMon),tenCongVan:item2.tenCongVan,maGiaoVien:Number(item2.maGiaoVien),noiDung:item2.noiDung,
        status:Number(item2.status),file:item2.file};
    }
    $scope.clearFormFix= function()
    {

        $scope.itemFix={maBoMon:Number($scope.itemTemp.maBoMon),tenCongVan:$scope.itemTemp.tenCongVan,maGiaoVien:Number($scope.itemTemp.maGiaoVien),noiDung:$scope.itemTemp.noiDung,
            status:Number($scope.itemTemp.status),file:$scope.itemTemp.file,maCongVan:$scope.itemTemp.maCongVan};

        $scope.search();

    }
    $scope.fix=function (itemFix) {
        let i = $scope.checkEdit();
        var form_data = new FormData();
        if (  $scope.fileDataFix!="")
        {
            form_data.append('file', $scope.fileDataFix);
        }

        form_data.append('fileName',itemFix.file);
        form_data.append('tenCongVan',itemFix.tenCongVan);
        form_data.append('maBoMon',itemFix.maBoMon);
        form_data.append('maGiaoVien',itemFix.maGiaoVien);
        form_data.append('noiDung',itemFix.noiDung);
        form_data.append('status',itemFix.status);
        form_data.append('maCongVan',$scope.itemTemp.maCongVan);
        if (i) {

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
                            toastr.success("Sửa công văn thành công");
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
    }
    $scope.delete=function (itemDelete) {
        $scope.maMon=Number(itemDelete.maMon);
    }
    $scope.deleteYes=function () {
        $.post(
            'index.php?controller=Mon&action=delete', // URL
            {maMon:$scope.maMon},  // Data
            function (response) {

                number = Number(response);
                switch (number) {
                    case 1:

                        $("#deletePackage").modal("hide");
                        $scope.clearForm();
                        toastr.success("Xóa thành công môn học");
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
    $scope.exportExcel=function () {
        window.open("index.php?controller=Mon&action=excel");
    }

}]);