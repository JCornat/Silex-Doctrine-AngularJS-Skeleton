(function() {

    var app = angular.module('app.account.service', []);

    app.factory('exampleService', ['$http', 'configService', function ($http, configService) {
        var url = configService.api();
        return {
            getOne: function (id) {
                return $http({
                    url: url + id,
                    method: 'GET'
                });
            }
        };
    }]);

})();