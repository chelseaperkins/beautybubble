(function(angular) {

    var beautyBubbleApp = angular.module('beautyBubbleApp', ['ui.bootstrap', 'localytics.directives', 'vcRecaptcha']);

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
        $scope.Model = {};
        $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
        $scope.isVerified = false;
        $scope.isSending = false;
        $scope.isFormAccepted = false;
        $scope.emailSendErrorMessage = "";
        $scope.setResponse = function (response) {
            $scope.isVerified = true;
            // send the `response` to your server for verification.
        };
        $scope.sendData = function () {
            // build the model
            var data = $scope.Model;
            $scope.isSending = true;
            $scope.sendPromise = $http.post($scope.ModelUrl, data)
            .success(function (data, status) {
                $scope.isSending = false;
                if (data.success) {
                    $scope.isFormAccepted = true;
                    $scope.emailSendErrorMessage = "";
                }
                else {
                    $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
                }
            })
            .error(function (data, status) {
                $scope.isSending = false;
                $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
            });
        };
        
        /* debug */
        $scope.Model.firstName = "Chelsea";
        $scope.Model.lastName = "Perkins";
        $scope.Model.email = "chelseaperkins6@gmail.com";
        $scope.Model.phNumber = "033557789";
        $scope.Model.mobileNumber = "+642194579";
        $scope.Model.facialTreatments = ["Facial - 60 minutes for $50"];
        $scope.Model.eyeTreatments = ["Eyelash Tint for $15", "Eyelash Perm for $30"];
    }
    ]);
    /* End of Appointment controller */

    beautyBubbleApp.controller('AddEditCtrl', ['$scope', '$http', function ctrl($scope, $http) {
        $scope.ModelUrl = window.location.pathname;
        //$scope.Model = pageModel;
        var now = new Date();
        $scope.Model = {};
        $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
        
    }
    ]);
// /* Contact controller */
//    beautyBubbleApp.controller('ContactCtrl', ['$scope', '$http', function ctrl($scope, $http) {
//        $scope.ModelUrl = window.location.pathname;
//        //$scope.Model = pageModel;
//               
//        $scope.isEmailSent = false;
//        $scope.emailSendErrorMessage = "";
//        $scope.sendEmail = function () {
//            // build the model
//            var data = $scope.Model;
//            $scope.sendPromise = $http.post($scope.ModelUrl, data)
//            .success(function (data, status) {
//                if (data.success) {
//                    $scope.isEmailSent = true;
//                    $scope.emailSendErrorMessage = "";
//                }
//                else {
//                    $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
//                }
//            })
//            .error(function (data, status) {
//                $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
//            });
//        };
//    }
//    ]);
//    /* End of Contact controller */

})(angular);