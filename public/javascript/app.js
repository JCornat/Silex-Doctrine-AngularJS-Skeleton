(function () {
    var app = angular.module('app', [
        'ui.router',
        'app.global.service', 'app.global.directive',
        'app.home.controller', 'app.account.controller'
    ]);

    app.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
        $stateProvider
            .state('home', {
                url: '/',
                views: {
                    '': {templateUrl: 'template/home.html'}
                }
            })
            .state('account', {
                url: '/account',
                views: {
                    '': {templateUrl: 'template/account.html'}
                }
            });
        $locationProvider.html5Mode(true);
        $urlRouterProvider.otherwise('/');
    }]);

    app.run([function() {

    }]);
})();