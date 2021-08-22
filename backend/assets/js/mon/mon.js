
var app = angular.module('packageApp', []);
app.config(['$provide', function($provide) {
    $provide.decorator('$locale', ['$delegate', function($delegate) {
        $delegate.NUMBER_FORMATS.DECIMAL_SEP = ',';
        $delegate.NUMBER_FORMATS.GROUP_SEP = '.';
        return $delegate;
    }]);
}])
app.controller('packageController', ['$scope', '$http', '$timeout', '$q', function ($scope, $http, $timeout, $q) {
    $scope.numberPerPage = 25;
    $http.get("index.php?controller=Mon&action=getAllMon",{params: {pageNumber:1}})
        .then(function (response) {
            console.log(response.data);
            $scope.listData = response.data;
            $scope.listData.numberPerPage = $scope.numberPerPage;
            $scope.listData.pageCount = getPageCount($scope.listData);
            $scope.listData.pageList = getPageList($scope.listData);
        });
}]);