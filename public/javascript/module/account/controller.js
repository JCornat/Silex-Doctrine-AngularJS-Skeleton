(function() {

    var app = angular.module('app.account.controller', []);

    app.controller('AccountCtrl', ['$stateParams', '$state', function ($stateParams, $state) {
        var self = this;

        self.accountName = "John Doe";
    }]);

})();
