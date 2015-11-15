(function () {
    var app = angular.module('app', [
        'ui.router', 'ngSanitize',
        'app.global.service', 'app.global.directive',
        'app.home.controller',
        'app.account.service', 'app.account.controller'
    ]);

    app.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
        $stateProvider
            .state('home', {
                url: '/',
                views: {
                    '': {
                        templateUrl: 'template/home.html',
                        controller: 'homeCtrl as ctrl'
                    }
                }
            })
            .state('account', {
                url: '/account',
                views: {
                    '': {
                        templateUrl: 'template/account.html',
                        controller: 'accountCtrl as ctrl'
                    }
                }
            });
        $locationProvider.html5Mode(true);
        $urlRouterProvider.otherwise('/');
    }]);

    app.run([function() {

    }]);
})();