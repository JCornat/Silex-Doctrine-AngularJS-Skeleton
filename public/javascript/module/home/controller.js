(function () {

    var app = angular.module('app.home.controller', []);

    app.controller('homeCtrl', ['$stateParams', '$state', function ($stateParams, $state) {
        var self = this;

        self.account = function () {
            $state.go('account');
        };
    }]);

})();
