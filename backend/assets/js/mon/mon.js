
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
    $scope.tenMon="";
    $scope.itemAdd={maBoMon:'',tenMon:'',sotiet:'',mota:''};

    $http.get("index.php?controller=Mon&action=getAllMon",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
            maBoMon:$scope.maBoMon,tenMon:$scope.tenMon}})
        .then(function (response) {
            console.log(response.data);
            $scope.listData = response.data;



        });
    $scope.search= function () {
        $http.get("index.php?controller=Mon&action=getAllMon",{params: {numberPerPage:$scope.numberPerPage,pageNumber:$scope.pageNumber,
                maBoMon:$scope.maBoMon,tenMon:$scope.tenMon}})
            .then(function (response) {
                $scope.listData = response.data;


            });
    }
    $scope.resetValue=function () {
        $scope.maBoMon="";
        $scope.tenMon="";
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
             'index.php?controller=Mon&action=add', // URL
             itemAdd,  // Data
             function (response) {

                 number = Number(response);
                 switch (number) {
                     case 1:

                         $("#addPackageForm").modal("hide");
                         toastr.success("Thêm mới môn học thành công");
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
        $scope.itemAdd.tenMon="";
        $scope.itemAdd.maBoMon="";
        $scope.itemAdd.sotiet="";
        $scope.itemAdd.mota="";

    }
   $scope.check=function () {
       const regex = new RegExp('^[0-9]{1,4}$')
        if($scope.itemAdd.maBoMon==""||$scope.itemAdd.maBoMon==null)
        {

            toastr.error("Hãy chọn bộ môn");
            return false
        }
       if($scope.itemAdd.tenMon==""||$scope.itemAdd.tenMon==null)
       {

           toastr.error("Hãy nhập tên môn");
           return false
       }
       if ($scope.itemAdd.sotiet==""||regex.test($scope.itemAdd.sotiet)==false)
       {
           toastr.error("Số tiết là số nhỏ hơn 4 chữ số");
           return false
       }
       if($scope.itemAdd.mota==""||$scope.itemAdd.mota==null)
       {

           toastr.error("Hãy nhập mô tả");
           return false
       }
       return true;
   }
    $scope.checkEdit=function () {
        const regex = new RegExp('^[0-9]{1,4}$')
        if($scope.itemFix.maBoMon==""||$scope.itemFix.maBoMon==null)
        {

            toastr.error("Hãy chọn bộ môn");
            return false
        }
        if($scope.itemFix.tenMon==""||$scope.itemFix.tenMon==null)
        {

            toastr.error("Hãy nhập tên môn");
            return false
        }
        if ($scope.itemFix.sotiet==""||regex.test($scope.itemFix.sotiet)==false)
        {
            toastr.error("Số tiết là số nhỏ hơn 4 chữ số");
            return false
        }
        if($scope.itemFix.moTa==""||$scope.itemFix.moTa==null)
        {

            toastr.error("Hãy nhập mô tả");
            return false
        }
        return true;
    }
   $scope.edit=function (item2) {
        $scope.itemTemp=item2;
       $scope.itemFix=$scope.itemTemp;
       $scope.itemFix.maBoMon=Number($scope.itemTemp.maBoMon);
   }
   $scope.clearFormFix= function()
    {
        console.log($scope.itemTemp);
        $scope.itemFix={maBoMon:'',tenMon:'',sotiet:'',mota:''};

        $scope.search();

    }
   $scope.fix=function () {
       let i = $scope.checkEdit();
       console.log($scope.itemFix);

       if (i) {

           itemFix = JSON.parse(JSON.stringify($scope.itemFix));
           $.post(
               'index.php?controller=Mon&action=update', // URL
               itemFix,  // Data
               function (response) {

                   number = Number(response);
                   switch (number) {
                       case 1:

                           $("#fix").modal("hide");
                           $scope.clearForm();
                           toastr.success("Sửa môn học thành công");
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