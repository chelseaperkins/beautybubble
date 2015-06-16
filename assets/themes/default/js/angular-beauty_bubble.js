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

            
            var now = new Date();
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
//       datepicker/make any day before the current day unselectable        
            $scope.toggleMin = function () {
                $scope.minDate = $scope.minDate ? null : new Date();
            };
            $scope.toggleMin();
//       datepicker/set dates unselectable up to a year
            $scope.toggleMax = function () {
                var date = new Date();
                $scope.maxDate = date.setDate((new Date()).getDate() + 365);
            };
            $scope.toggleMax();
//            open datepicker
            $scope.datePickerOpened = function ($event) {
                $event.preventDefault();
                $event.stopPropagation();
                $scope.opened = true;
            };

            $scope.isVerified = false;
            $scope.isSending = false;
            $scope.isFormAccepted = false;
            $scope.emailSendErrorMessage = "";
            $scope.setResponse = function (response) {
                $scope.isVerified = true;
                // send the `response` to server for verification.
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
                            } else if (!data.success) {
                                $scope.isFormAccepted = false;
                                $scope.emailSendErrorMessage = data.message;
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
            
            $scope.isAnyTreatmentSet = function () {
                return $scope.isTreatmentSet($scope.Model.eyeTreatments) ||
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
                var result = false;
                
                return $scope.isVerified && (form.$invalid || !$scope.isAnyTreatmentSet());
            };
            
            $scope.canSubmit = function (form) {
                return form.$valid && $scope.isAnyTreatmentSet() && !$scope.isSending;
            };
        }
    ]);
    /* End of Appointment controller */

    beautyBubbleApp.directive('minTime', function (){ 
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function(scope, elem, attrs, ctrl) {
                var minTime;

                scope.$watch(attrs.minTime, function(newVal) {
                    minTime = newVal;
                    validate();
                });

                scope.$watch(attrs.ngModel, validate);

                function validate(value) {
                    if(ctrl.$modelValue instanceof Date){
                        var minDate = new Date(ctrl.$modelValue);
                        minDate.setHours(minTime / 100);
                        var isValid = (minDate < ctrl.$modelValue);
                        //ctrl.$setValidity('minTime', (minDate < ctrl.$modelValue));
                        ctrl.$modelValue = isValid ? value : minDate;
                    }
                    return value;
                }
            }
        };
    })
})(angular);