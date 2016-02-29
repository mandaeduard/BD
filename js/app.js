var app = angular.module('blog', [ ]);

app.controller('HomeController', ['$scope', function($scope) {
  $scope.helloWorld = 'Aplicatii Web cu suport Java!';

}]);
