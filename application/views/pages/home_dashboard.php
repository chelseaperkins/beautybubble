<div class="dashbd_wrap" ng-app="beautyBubbleApp" ng-controller="DashboardCtrl">
    <div class="row dashbd_home_content">

        <div class="col-md-12 col-md-push-3 ">
            <div class="dashbd_home_text">
                <h1><strong><?php echo"DASHBOARD"; ?></strong></h1>
                <hr>
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul id="dash-tabs" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#appointments" aria-controls="appointments" role="tab" data-toggle="tab">Appointments</a></li>
                        <li role="presentation"><a href="#clients" aria-controls="clients" role="tab" data-toggle="tab">Clients</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="appointments">
                            <div class="row"> <h3><?php echo"Todays appointments"; ?></h3>
                                <hr>
                                <br />
                                
                                <div class="col-md-4">                                
                                        <a href="#"ng-click="openAddModal()"><span class="glyphicon glyphicon-plus-sign"></span> Add appointment</a>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                    <label><?php echo"Search appointments:"; ?></label>
                                    <input class="form-control" ng-model="appointmentFilter" placeholder="Type to search">
                                </div>
                               
                            </div> 
                            <br />
                            <div class="row">
                                <!--displays html repeatedly for each appointment/ create variable 'apptmt' to take values from model to match with db values /filters appointments for search input-->
                                <div class="col-sm-4 col-md-4" ng-repeat="apptmt in Model.results| filter:appointmentFilter | orderBy:'date_time'">
                                    <div class="dash_appointment_cell">
                                        <a class="dash_dropdown_btn btn btn-white dropdown-toggle" data-toggle="dropdown"></a>
                                        <div class="class-tile-menu-toggle btn-group">
                                            <a class="dash_dropdown_btn btn btn-white dropdown-toggle img-circle" data-toggle="dropdown"><b class="caret"></b></a>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#" ng-click="openEditModal(apptmt)" ><span class="glyphicon glyphicon-edit"></span> Edit Appointment</a></li>
                                                <li><a href="#" ng-click="openDeleteModal(apptmt)"><span class="glyphicon glyphicon-remove-sign"></span> Delete Appointment</a></li>
                                            </ul>
                                        </div>

                                        <!--displays values from database repeatedly-->
                                        <div>
                                            <font size="2">
                                            <strong><h4>Client:</h4></strong>
                                            <div>
                                                <label>First Name: {{apptmt.first_name}} </label> 
                                                <br />
                                                <label>Last Name: {{apptmt.last_name}}</label>
                                                <br />
                                                <label>Email: {{apptmt.email}}</label>
                                                <br />
                                            </div>

                                            <h4>Treatments:</h4>

                                            <div>
                                                <label ng-hide="apptmt.facialTreatments == null || apptmt.facialTreatments.length == 0">Facial Treatments:</label> 
                                                <span ng-repeat="item in apptmt.facialTreatments">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.eyeTreatments == null || apptmt.eyeTreatments.length == 0">Eye Treatments:</label> 
                                                <span ng-repeat="item in apptmt.eyeTreatments">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.bodyTreatments == null || apptmt.bodyTreatments.length == 0">Body Treatments:</label> 
                                                <span ng-repeat="item in apptmt.bodyTreatments">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.sprayTanning == null || apptmt.sprayTanning.length == 0">Spray Tanning:</label> 
                                                <span ng-repeat="item in apptmt.sprayTanning">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.nailTreatments == null || apptmt.nailTreatments.length == 0">Nail Treatments:</label> 
                                                <span ng-repeat="item in apptmt.nailTreatments">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.waxingTreatments == null || apptmt.waxingTreatments.length == 0">Waxing Treatments:</label> 
                                                <span ng-repeat="item in apptmt.waxingTreatments">{{item}} </span>
                                                <br />
                                                <label ng-hide="apptmt.electrolysis == null || apptmt.electrolysis.length == 0">Electrolysis:</label> 
                                                <span ng-repeat="item in apptmt.electrolysis">{{item}} </span>
                                                <br />
                                            </div>
                                            <label><h4>Date and Time:</h4></label>
                                            <div>
                                                <span>{{apptmt.dateTime| date:'dd MMMM hh:mm a'}} </span><br /> 
                                            </div>
                                            </font>                     
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="clients">
                            <h3><?php echo"Client list"; ?></h3>
                            <hr>
                            <br />
                            <div class="row client-table" >
                                
                                <div class="col-md-8"><p>Select client's details to view their appointments</p></div>
                                <div class="col-md-4">
                                    <label><?php echo"Search client list:"; ?></label>
                                    <input class="form-control" ng-model="clientFilter" placeholder="Type to search">


                                </div>
                            </div>
                            <br />
                            <div class="col-md-12">

                                <font size="2">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Mobile Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="user in Model.clients| filter:clientFilter" ng-click="selectAppointments(user)">
                                            <td>{{user.first_name}}</td>
                                            <td>{{user.last_name}}</td>
                                            <td>{{user.email}}</td>
                                            <td>{{user.ph_number}}</td>
                                            <td>{{user.mobile_number}}</td>

                                        </tr>
                                    </tbody>

                                </table>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!--    Modal content for ModalAddCtrl controller-->
                <script type="text/ng-template" id="addAppointmentModalContent.html">
                    <div class="modal-header">
                    <h3 class="modal-title">Add new appointment</h3>
                    </div>
                    <div class="modal-body">
                    <form name="appointmentForm" novalidate ng-submit="sendData()">
                    <div class="form-group">
                    <span class="error" ng-show="!appointmentForm.first_name.$valid">First name input error</span>
                    <input type="text" ng-model="appointment.firstName" class="form-control" name="first_name" placeholder="Enter First Name" ng-pattern="/^[a-zA-Z]*$/">
                    </div>
                    <div class="form-group">
                    <span class="error" ng-show="!appointmentForm.last_name.$valid">Last name input error</span>
                    <input type="text" ng-model="appointment.lastName" class="form-control" name="last_name" placeholder="Enter Last Name"  ng-pattern="/^[a-zA-Z]*$/">
                    </div>
                    <div class="form-group">
                    <span class="error" ng-show="!appointmentForm.email.$valid && appointmentForm.email.$touched">Email input error</span>
                    <input type="email" ng-model="appointment.email" class="form-control" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                    <span class="error" ng-show="!appointmentForm.ph_number.$valid">Phone number input error</span>
                    <input type="text" ng-model="appointment.phNumber" class="form-control" name="ph_number" ng-pattern="/^[+0-9]*$/" placeholder="Enter Home Phone Number">
                    </div>
                    <div class="form-group">
                    <span class="error" ng-show="!appointmentForm.mobile_number.$valid">Mobile input error</span>
                    <input type="text" ng-model="appointment.mobilePhone" class="form-control" name="mobile_number" ng-pattern="/^[+0-9]*$/" placeholder="Enter Mobile Phone Number">
                    </div>
                    <div class="form-group">
                    <label for="facial_treatments">Facial Treatments</label>
                    <select multiple ng-model="appointment.facialTreatments" class="chosen-select">
                    <option value="Select treatment">Select a treatment</option>
                    <option value="Facial - 60 minutes for $50">Facial - 60 minutes for $50</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="eye_treatments">Eye Treatments</label>
                    <select multiple ng-model="appointment.eyeTreatments" class="chosen-select" >
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Eyelash Tint for $15">Eyelash Tint for $15</option>
                    <option value="Eyebrow Tint for $10">Eyebrow Tint for $10</option>
                    <option value="Eyebrow Tint and Lash Tint for $20">Eyebrow Tint and Lash Tint for $20</option>
                    <option value="Eyebrow Shape and Brow Tint for $15">Eyebrow Shape and Brow Tint for $15</option>
                    <option value="Eyebrow Tint, Shape and Lash Tint for $25">Eyebrow Tint, Shape and Lash Tint for $25</option>
                    <option value="Eyebrow Perm for $30">Eyebrow Perm for $30</option>
                    </select>
                    </div> 
                    <div class="form-group">
                    <label for="body_treatments">Body Treatments</label>
                    <select multiple ng-model="appointment.bodyTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Full Body Massage - 60 minutes for $80">Full Body Massage - 60 minutes for $80</option>
                    <option value="Back, Neck and Shoulder - 30 minutes for $40">Back, Neck and Shoulder - 30 minutes for $40</option>
                    </select>  
                    </div>
                    <div class="form-group">
                    <label for="spray_tanning">Spray Tanning</label>
                    <select multiple ng-model="appointment.sprayTanning" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Full Body for $30">Full Body for $30</option>
                    <option value="Half Body for $20">Half Body for $20</option>
                    </select>                          
                    </div>
                    <div class="form-group">
                    <label for="nail_treatments">Nail Treatments</label>
                    <select multiple ng-model="appointment.nailTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Deluxe Manicure - 60 minutes for $45">Deluxe Manicure - 60 minutes for $45</option>
                    <option value="Mini Manicure - 30 minutes for $30">Mini Manicure - 30 minutes for $30</option>
                    <option value="File and Polish for $15">File and Polish for $15</option>
                    <option value="Deluxe Pedicure - 60 minutes for $50">Deluxe Pedicure - 60 minutes for $50</option>
                    <option value="Mini Pedicure - 30 minutes for $35">Mini Pedicure - 30 minutes for $35</option>
                    <option value="Shallac Gel Polish Removel for $10">Shallac Gel Polish Removel for $10</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="waxing_treatments">Waxing Treatments</label>
                    <select multiple ng-model="appointment.waxingTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Underarm wax for $15">Underarm wax for $15</option>
                    <option value="Forearm wax for $20">Forearm wax for $20</option>
                    <option value="Back or Chest wax for $35">Back or Chest wax for $35</option>
                    <option value="1/2 Leg wax for $20">1/2 Leg wax for $20</option>
                    <option value="Full leg wax for $30">Full leg wax for $30</option>
                    <option value="Bikini wax for $20">Bikini wax for $20</option>
                    <option value="Extended Bikini wax for $25">Extended Bikini wax for $25</option>
                    <option value="Full Leg & Bikini wax for $30">Full Leg & Bikini wax for $30</option>
                    <option value="Full Leg & Bikini & underarm wax for $50">Full Leg & Bikini & underarm wax for $50</option>
                    <option value="Half leg & Bikini wax for $30">Half leg & Bikini wax for $30</option>
                    <option value="Half Leg  & Bikini & underarm wax for $40">Half Leg  & Bikini & underarm wax for $40</option>
                    <option value="Eyebrow shape for $10">Eyebrow shape for $10</option>
                    <option value="Brazilian wax for $35">Brazilian wax for $35</option>
                    <option value="Upper lip or chin for $10">Upper lip or chin for $10</option>
                    <option value="Facial Bleaching $ 5 per area">Facial Bleaching $ 5 per area</option>
                    </select>                           
                    </div>
                    <div class="form-group">
                    <label for="electrolysis">Electrolysis</label>
                    <select multiple ng-model="appointment.electrolysis" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="15 minutes (minimum appointment) for $25">15 minutes (minimum appointment) for $25</option>
                    <option value="30 minutes for $40">30 minutes for $40</option>
                    </select>   
                    </div>
                    <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <p class="input-group">
                    <input type="text" ng-model="appointment.dateTime"  class="form-control" id="appointment_date" datepicker-popup="dd-MMMM-yyyy" is-open="opened" min-date="minDate" max-date="maxDate" close-text="Close" required>
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="datePickerOpened($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                    </span>
                    </p>
                    </form>
                    <div class="form-group">
                    <label for="appointment_time">Appointment Time</label>                                                          
                    <timepicker ng-model="appointment.dateTime" minTime="0800" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                    </div>           
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary" ng-click="submitData()">Submit</button>
                    <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
                    </div>
                </script>


                <!--    Modal content for ModalEditCtrl controller-->
                <script type="text/ng-template" id="editAppointmentModalContent.html" class="modal">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Appointment</h2>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                    <div class="col-md-8">                 
                    <form>   
                    <div class="form-group">
                    <label for="facial_treatments">Facial Treatments</label>
                    <select multiple ng-model="appointment.facialTreatments" class="chosen-select">
                    <option value="Select treatment">Select a treatment</option>
                    <option value="Facial - 60 minutes for $50">Facial - 60 minutes for $50</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="eye_treatments">Eye Treatments</label>

                    <select multiple ng-model="appointment.eyeTreatments" class="chosen-select" >
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Eyelash Tint for $15">Eyelash Tint for $15</option>
                    <option value="Eyebrow Tint for $10">Eyebrow Tint for $10</option>
                    <option value="Eyebrow Tint and Lash Tint for $20">Eyebrow Tint and Lash Tint for $20</option>
                    <option value="Eyebrow Shape and Brow Tint for $15">Eyebrow Shape and Brow Tint for $15</option>
                    <option value="Eyebrow Tint, Shape and Lash Tint for $25">Eyebrow Tint, Shape and Lash Tint for $25</option>
                    <option value="Eyebrow Perm for $30">Eyebrow Perm for $30</option>
                    </select>
                    </div> 

                    <div class="form-group">
                    <label for="body_treatments">Body Treatments</label>
                    <select multiple ng-model="appointment.bodyTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Full Body Massage - 60 minutes for $80">Full Body Massage - 60 minutes for $80</option>
                    <option value="Back, Neck and Shoulder - 30 minutes for $40">Back, Neck and Shoulder - 30 minutes for $40</option>
                    </select>  
                    </div>

                    <div class="form-group">
                    <label for="spray_tanning">Spray Tanning</label>
                    <select multiple ng-model="appointment.sprayTanning" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Full Body for $30">Full Body for $30</option>
                    <option value="Half Body for $20">Half Body for $20</option>
                    </select>                          
                    </div>

                    <div class="form-group">
                    <label for="nail_treatments">Nail Treatments</label>
                    <select multiple ng-model="appointment.nailTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Deluxe Manicure - 60 minutes for $45">Deluxe Manicure - 60 minutes for $45</option>
                    <option value="Mini Manicure - 30 minutes for $30">Mini Manicure - 30 minutes for $30</option>
                    <option value="File and Polish for $15">File and Polish for $15</option>
                    <option value="Deluxe Pedicure - 60 minutes for $50">Deluxe Pedicure - 60 minutes for $50</option>
                    <option value="Mini Pedicure - 30 minutes for $35">Mini Pedicure - 30 minutes for $35</option>
                    <option value="Shallac Gel Polish Removel for $10">Shallac Gel Polish Removel for $10</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="waxing_treatments">Waxing Treatments</label>
                    <select multiple ng-model="appointment.waxingTreatments" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="Underarm wax for $15">Underarm wax for $15</option>
                    <option value="Forearm wax for $20">Forearm wax for $20</option>
                    <option value="Back or Chest wax for $35">Back or Chest wax for $35</option>
                    <option value="1/2 Leg wax for $20">1/2 Leg wax for $20</option>
                    <option value="Full leg wax for $30">Full leg wax for $30</option>
                    <option value="Bikini wax for $20">Bikini wax for $20</option>
                    <option value="Extended Bikini wax for $25">Extended Bikini wax for $25</option>
                    <option value="Full Leg & Bikini wax for $30">Full Leg & Bikini wax for $30</option>
                    <option value="Full Leg & Bikini & underarm wax for $50">Full Leg & Bikini & underarm wax for $50</option>
                    <option value="Half leg & Bikini wax for $30">Half leg & Bikini wax for $30</option>
                    <option value="Half Leg  & Bikini & underarm wax for $40">Half Leg  & Bikini & underarm wax for $40</option>
                    <option value="Eyebrow shape for $10">Eyebrow shape for $10</option>
                    <option value="Brazilian wax for $35">Brazilian wax for $35</option>
                    <option value="Upper lip or chin for $10">Upper lip or chin for $10</option>
                    <option value="Facial Bleaching $ 5 per area">Facial Bleaching $ 5 per area</option>
                    </select>                           
                    </div>

                    <div class="form-group">
                    <label for="electrolysis">Electrolysis</label>
                    <select multiple ng-model="appointment.electrolysis" class="chosen-select">
                    <option value="Select one or multiple treatments">Select a treatment</option>
                    <option value="15 minutes (minimum appointment) for $25">15 minutes (minimum appointment) for $25</option>
                    <option value="30 minutes for $40">30 minutes for $40</option>
                    </select>   
                    </div>

                    <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <p class="input-group">
                    <input type="text" class="form-control" datepicker-popup="dd-MMMM-yyyy" ng-model="appointment.dateTime" is-open="opened" min-date="minDate" max-date="maxDate"  close-text="Close" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="datePickerOpened($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                    </span>
                    </p>            
                    </div>


                    <div class="form-group">
                    <label for="appointment_time">Appointment Time</label>                                                          
                    <timepicker hour-step="1" minute-step="15"  min-time="8" show-meridian="true" mousewheel="true" ng-model="appointment.dateTime" required></timepicker>
                    </div>
                    </form>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-default form_submit" ng-click="saveData()">Save</button>
                    <button class="btn btn-default form_submit" ng-click="cancel()">Cancel</button>
                    </div>
                </script>

                <!--    Modal content for ModaldeleteCtrl controller-->
                <script type="text/ng-template" id="deleteAppointmentModalContent.html" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title"><span class="glyphicon glyphicon-remove"></span> Delete Appointment</h2>
                    </div>
                    <div class="modal-body">
                    <p>Are you sure you want to delete this appointment?</p>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-default form_submit" ng-click="cancel()">No</button>
                    <button class="btn btn-default form_submit" ng-click="delete()">Yes</button>


                    </div>
                </script>

                <script>
                    //        
                    var pageModel = <?php echo json_encode($pageModel); ?>;

                </script>

            </div>
        </div>
</div>

