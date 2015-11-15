(function () {
    var app = angular.module('app.global.service', []);

    app.factory('configService', [function () {
        return {
            api: function () {
                return 'http://api.sda-skeleton.com/api/';
            }
        }
    }]);
})();

