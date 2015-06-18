(function (angular) {

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

            $scope.Model = {};
            $scope.hideFields = false;
            $scope.isVerified = false;
            $scope.isSending = false;
            $scope.isFormAccepted = false;
            $scope.emailSendErrorMessage = "";
            $scope.submitText = "Send";
            var now = new Date();
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
//       datepicker/make any day before the current day unselectable        
            $scope.toggleMin = function () {
                $scope.minDate = $scope.minDate ? null : new Date();
            };
            
//       datepicker/set dates unselectable up to a year
            $scope.toggleMax = function () {
                var date = new Date();
                $scope.maxDate = date.setDate((new Date()).getDate() + 365);
            };
            
            $scope.toggleMin();
            $scope.toggleMax();
//            open datepicker
            $scope.datePickerOpened = function ($event) {
                $event.preventDefault();
                $event.stopPropagation();
                $scope.opened = true;
            };

            
            $scope.setResponse = function (response) {
                $scope.isVerified = true;
                // send the `response` to server for verification.
            };
            $scope.sendData = function () {
                // build the model               
                var data = $scope.Model;
                $scope.submitText = "Sending...";
                $scope.isSending = true;
                $scope.sendPromise = $http.post($scope.ModelUrl, data)
                        .success(function (data, status) {
                            $scope.isSending = false;
                            $scope.submitText = "Send";
                            if (data.success) {
                                $scope.isFormAccepted = true;
                                $scope.emailSendErrorMessage = "";
                                
                                // scroll up
                                $('html, body').animate({
                                    scrollTop: $('#appointmentcontentblock').offset().top - 200 + 'px'
                                }, 'fast');
                                
                            } else if (!data.success) {
                                $scope.isFormAccepted = false;
                                $scope.emailSendErrorMessage = data.message;
                            }
                            else {
                                $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
                            }
                        })
                        .error(function (data, status) {
                            $scope.submitText = "Send";
                            $scope.isSending = false;
                            $scope.emailSendErrorMessage = "We are sorry as there was an issue sending your message. Please try again.";
                        });
            };
            
            $scope.isAnyTreatmentSet = function () {
                return $scope.isTreatmentSet($scope.Model.facialTreatments) ||
                       $scope.isTreatmentSet($scope.Model.eyeTreatments) ||
                       $scope.isTreatmentSet($scope.Model.bodyTreatments) ||
                       $scope.isTreatmentSet($scope.Model.sprayTanning) ||
                       $scope.isTreatmentSet($scope.Model.nailTreatments) ||
                       $scope.isTreatmentSet($scope.Model.waxingTreatments) ||
                       $scope.isTreatmentSet($scope.Model.electrolysis);
            };
            
            $scope.isTreatmentSet = function (treatment) {
                return (treatment != null && treatment.length);
            };
            
            $scope.showFormErrorMessage = function (form) {
                return $scope.isVerified && (form.$invalid || !$scope.isAnyTreatmentSet());
            };
            
            $scope.canSubmit = function (form) {
                return form.$valid && $scope.isAnyTreatmentSet() && !$scope.isSending;
            };
        }
    ]);
    /* End of Appointment controller */
    
    /* Template controller */
    beautyBubbleApp.controller('ContactCtrl', ['$scope', '$http', function ctrl($scope, $http) {
            $scope.isVerified = false;
            
            $scope.setResponse = function (response) {
                $scope.isVerified = true;
                // send the `response` to server for verification.
            };
        }
    ]);
    /* End of Template controller */

    beautyBubbleApp.directive('datepickerPopup', function (){
        return {
            restrict: 'EAC',
            require: 'ngModel',
            link: function(scope, element, attr, controller) {
          //remove the default formatter from the input directive to prevent conflict
          controller.$formatters.shift();
      }
    };
    });
})(angular);