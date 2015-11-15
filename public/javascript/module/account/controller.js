(function() {

    var app = angular.module('app.account.controller', []);

    app.controller('accountCtrl', ['$stateParams', '$state', 'exampleService', function ($stateParams, $state, exampleService) {
        var self = this;

        self.name = "John Doe";

        exampleService.getOne(1)
            .success(function(data) {
                self.example = data.data;
            })
            .error(function(data) {
                console.log(data);
            });
    }]);

})();
