(function(angular) {

    var beautyBubbleApp = angular.module('beautyBubbleApp', ['ui.bootstrap', 'localytics.directives']);

    /* Template controller */
    beautyBubbleApp.controller('TemplateCtrl', ['$scope', '$http', function ctrl($scope, $http) {
        $scope.ModelUrl = window.location.pathname;
        $scope.Model = pageModel;
    }
    ]);
    /* End of Template controller */
    
    

    /* Appointment controller */
    beautyBubbleApp.controller('AppointmentCtrl', ['$scope', '$http', function ctrl($scope, $http) {
        $scope.ModelUrl = window.location.pathname;
        //$scope.Model = pageModel;
        var now = new Date();
        $scope.time = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
        
        $scope.isEmailSent = false;
        $scope.emailSendErrorMessage = "";
        $scope.sendEmail = function () {
            // build the model
            var data = $scope.Model;
            $scope.sendPromise = $http.post($scope.ModelUrl, data)
            .success(function (data, status) {
                if (data.success) {
                    $scope.isEmailSent = true;
                    $scope.emailSendErrorMessage = "";
                }
                else {
                    $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
                }
            })
            .error(function (data, status) {
                $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
            });
        };
    }
    ]);
    /* End of Appointment controller */

 /* Contact controller */
    beautyBubbleApp.controller('ContactCtrl', ['$scope', '$http', function ctrl($scope, $http) {
        $scope.ModelUrl = window.location.pathname;
        //$scope.Model = pageModel;
               
        $scope.isEmailSent = false;
        $scope.emailSendErrorMessage = "";
        $scope.sendEmail = function () {
            // build the model
            var data = $scope.Model;
            $scope.sendPromise = $http.post($scope.ModelUrl, data)
            .success(function (data, status) {
                if (data.success) {
                    $scope.isEmailSent = true;
                    $scope.emailSendErrorMessage = "";
                }
                else {
                    $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
                }
            })
            .error(function (data, status) {
                $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
            });
        };
    }
    ]);
    /* End of Contact controller */

})(angular);