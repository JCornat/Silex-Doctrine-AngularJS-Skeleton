(function () {
    var app = angular.module('app', [
        'ui.router', 'ngSanitize',
        'app.global.service', 'app.global.directive',
        'app.home.controller', 'app.account.controller'
    ]);

    app.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
        $stateProvider
            .state('home', {
                url: '/',
                views: {
                    '': {templateUrl: 'controller/global/view/home.html'}
                }
            })
            .state('account', {
                url: '/account',
                views: {
                    '': {templateUrl: 'controller/global/view/account.html'}
                }
            });
        $urlRouterProvider.otherwise('home');
    }]);

    app.run([function() {

    }]);
})();