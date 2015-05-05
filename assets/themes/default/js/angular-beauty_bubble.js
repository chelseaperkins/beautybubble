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

            var now = new Date();
            $scope.Model = {};
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

//        /* debug */
//        $scope.Model.firstName = "Chelsea";
//        $scope.Model.lastName = "Perkins";
//        $scope.Model.email = "chelseaperkins6@gmail.com";
//        $scope.Model.phNumber = "033557789";
//        $scope.Model.mobileNumber = "+642194579";
//        $scope.Model.facialTreatments = ["Facial - 60 minutes for $50"];
//        $scope.Model.eyeTreatments = ["Eyelash Tint for $15", "Eyelash Perm for $30"];
        }
    ]);
    /* End of Appointment controller */
          
    /* Dashboard controller */
    beautyBubbleApp.controller('DashboardCtrl', ['$scope', '$http', '$modal',  function ctrl($scope, $http, $modal) {
            $scope.ModelUrl = window.location.pathname;

            var now = new Date();
            $scope.Model = pageModel;
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
            
//            Opens edit modal and populates the appointment values from the database to allow edit functionality
            $scope.openEditModal = function (appointment) {

                var modalInstance = $modal.open({
                    templateUrl: 'editAppointmentModalContent.html',
                    controller: 'ModalEditCtrl',
                    size: 'lg',
                    resolve: {
                        appointment: function () {
                            return appointment;
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                }, function () {
                    //$log.info('Modal dismissed at: ' + new Date());
                });
            };
            
//            Opens add modal, add appointment functionality
            $scope.openAddModal = function (appointment) {

                var modalInstance = $modal.open({
                    templateUrl: 'addAppointmentModalContent.html',
                    controller: 'ModalAddCtrl',
                    size: 'lg',
                    resolve: {
                        appointment: function () {
                            return appointment;
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                }, function () {
                    //$log.info('Modal dismissed at: ' + new Date());
                });
            };
            
//            Opens admin profile modal, create admin profile details
            $scope.openProfileModal = function (size) {

                var modalInstance = $modal.open({
                    templateUrl: 'profileAppointmentModalContent.html',
                    controller: 'ModalProfileCtrl',
                    size: 'lg',
                    resolve: {
                        items: function () {
                            return [];
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                }, function () {
                    //$log.info('Modal dismissed at: ' + new Date());
                });
            };
            
 //            Opens delete message modal, deletes values           
            $scope.openDeleteModal = function (appointment) {

                var modalInstance = $modal.open({
                    templateUrl: 'deleteAppointmentModalContent.html',
                    controller: 'ModalDeleteCtrl',
                    size: 'lg',
                    resolve: {
                        appointment: function () {
                            return appointment;
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                }, function () {
                    //$log.info('Modal dismissed at: ' + new Date());
                });
            };
            
            $scope.createDateFromMysql = function(mysql_string)
            { 
               if(typeof mysql_string === 'string')
               {
                  var t = mysql_string.split(/[- :]/);

                  //when t[3], t[4] and t[5] are missing they defaults to zero
                  return new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);          
               }

               return null;   
            };
                       
        }
    ]);
    
//  Controller for edit modal
    beautyBubbleApp.controller('ModalEditCtrl', function ($scope, $modalInstance, $timeout, appointment, $http) {
        $scope.ModelUrl = window.location.pathname+'/edit';
        
        $scope.appointment = appointment;
           
        $scope.saveData = function () {
            var now = new Date();
//            var n = now.toLocaleDateString();
            $scope.Model = {};
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
            
             // build the model
                var data = $scope.appointment;
                $scope.isSaving = true;
                $scope.sendPromise = $http.post($scope.ModelUrl, data)
                        .success(function (data, status) {
                            $scope.isSaving = false;
                            if (data.success) {
                                $scope.dataSent = true;
                                $scope.dataSendErrorMessage = "";
                            }
                            else {
                                $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                            }
                        })
                        .error(function (data, status) {
                            $scope.isSaving = false;
                            $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                        });
            
                        
            $modalInstance.close("saved");
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
//       make any day before the current day unselectable        
        $scope.toggleMin = function () {
            $scope.minDate = $scope.minDate ? null : new Date();
        };
        $scope.toggleMin();
        
//       allows dates to be selectable up to a year from current date
        $scope.toggleMax = function () {
            var date = new Date();
        $scope.maxDate = date.setDate((new Date()).getDate() + 365);
        };
        $scope.toggleMax();

        $scope.datePickerOpened = function ($event) {
            $event.preventDefault();
            $event.stopPropagation();

            $scope.opened = true;
        };
       
        
        //   timer to allow chosen plugin set width        
        $timeout(function () {
            $(".chosen-select").chosen({width: "100%"});
        }, 200);
        
        
    });
    
    beautyBubbleApp.controller('ModalAddCtrl', function ($scope, $modalInstance, $timeout, $http, appointment) {
               
        $scope.ModelUrl = window.location.pathname+'/add';
        $scope.appointment = appointment;
        $scope.submitData = function () {
            var now = new Date();
//            var n = now.toLocaleDateString();
            $scope.Model = {};
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
            
             // build the model
                var data = $scope.appointment;
                $scope.isSaving = true;
                $scope.sendPromise = $http.post($scope.ModelUrl, data)
                        .success(function (data, status) {
                            $scope.isSaving = false;
                            if (data.success) {
                                $scope.dataSent = true;
                                $scope.dataSendErrorMessage = "";
                            }
                            else {
                                $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                            }
                        })
                        .error(function (data, status) {
                            $scope.isSaving = false;
                            $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                        });
            
                        
            $modalInstance.close("saved");
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
        
        $scope.close = function (){
            $modalInstance.close($scope.selected.item);
        };
        //       make any day before the current day unselectable        
        $scope.toggleMin = function () {
            $scope.minDate = $scope.minDate ? null : new Date();
        };
        $scope.toggleMin();
        
//       allows dates to be selectable up to a year from current date
        $scope.toggleMax = function () {
            var date = new Date();
        $scope.maxDate = date.setDate((new Date()).getDate() + 365);
        };
        $scope.toggleMax();

        $scope.datePickerOpened = function ($event) {
            $event.preventDefault();
            $event.stopPropagation();

            $scope.opened = true;
        };
        
        //   timer to allow chosen plugin set width 
        $timeout(function () {
            $(".chosen-select").chosen({width: "100%"});
        }, 200);
    });
    
    beautyBubbleApp.controller('ModalProfileCtrl', function ($scope, $modalInstance, $timeout, items) {
        
        $scope.ModelUrl = window.location.pathname+'/profile';
       
        $scope.submitData = function () {
            var now = new Date();
//            var n = now.toLocaleDateString();
            $scope.Model = {};
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
            
             // build the model
                var data = $scope.Model;
                $scope.isSaving = true;
                $scope.sendPromise = $http.post($scope.ModelUrl, data)
                        .success(function (data, status) {
                            $scope.isSaving = false;
                            if (data.success) {
                                $scope.dataSent = true;
                                $scope.dataSendErrorMessage = "";
                            }
                            else {
                                $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                            }
                        })
                        .error(function (data, status) {
                            $scope.isSaving = false;
                            $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                        });
            
                        
            $modalInstance.close("saved");
        };

        $scope.ok = function () {
            $modalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
        
        $scope.close = function (){
            $modalInstance.close($scope.selected.item);
        };
        //   timer to allow chosen plugin set width 
        $timeout(function () {
            $(".chosen-select").chosen({width: "100%"});
        }, 200);
    });
    
    beautyBubbleApp.controller('ModalDeleteCtrl', function ($scope, $modalInstance, $timeout, $http, appointment) {
               $scope.ModelUrl = window.location.pathname+'/delete';
               $scope.appointment = appointment;
        $scope.delete = function () {
           var now = new Date();
//            var n = now.toLocaleDateString();
            $scope.Model = {};
            $scope.Model.dateTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 0);
            
             // build the model
                var data = $scope.appointment;
                $scope.isSaving = true;
                $scope.sendPromise = $http.post($scope.ModelUrl, data)
                        .success(function (data, status) {
                            $scope.isSaving = false;
                            if (data.success) {
                                $scope.dataSent = true;
                                $scope.dataSendErrorMessage = "";
                            }
                            else {
                                $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                            }
                        })
                        .error(function (data, status) {
                            $scope.isSaving = false;
                            $scope.dataSendErrorMessage = "Data saving error, Please try again.";
                        });
            
                        
            $modalInstance.close("saved");
        };
        

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
        
        //    timer to allow chosen plugin set width 
        $timeout(function () {
            $(".chosen-select").chosen({width: "100%"});
        }, 200);
    });
        /* End of Dashboard controller */
        
        
    
        
})(angular);