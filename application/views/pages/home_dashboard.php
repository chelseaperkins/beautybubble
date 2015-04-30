<div class="dashbd_wrap" ng-app="beautyBubbleApp" ng-controller="DashboardCtrl">
    <div class="row dashbd_home_content">
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <div class="dashbd_home_text">
                <h1><strong><?php echo"DASHBOARD"; ?></strong></h1>
                <p><?php echo"Todays appointments"; ?></p>

                <div class="row">
                    <div class="col-sm-4 col-md-4 text center" ng-repeat="apptmt in Model.results">
                        <div class="dash_appointment_cell">
                            <a class="dash_dropdown_btn btn btn-white dropdown-toggle" data-toggle="dropdown"></a>
                            <div class="class-tile-menu-toggle btn-group">
                                <a name="class_tile_dropdown" class="dash_dropdown_btn btn btn-white dropdown-toggle img-circle" data-toggle="dropdown"><b class="caret"></b></a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#" ng-click="openEditModal(apptmt)" ><span class="glyphicon glyphicon-edit"></span> Edit Appointment</a></li>
                                    <li><a class="edit-class"><span class="glyphicon glyphicon-remove-sign"></span> Delete Appointment</a></li>
                                </ul>
                            </div>
                            <div>
                                <span ng-repeat="item in apptmt.eyeTreatments">{{item}} </span>
                                
                                
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <a href="#" ng-click="openAddModal()">
                            <div class="dash_appointment_cell">
                                <span class="glyphicon glyphicon-plus-sign"></span> Add
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="dash_appointment_cell">

                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="dash_appointment_cell">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>

    <script type="text/ng-template" id="addAppointmentModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Add new appointment</h3>
        </div>
        <div class="modal-body">
                <form>   
                        <div class="form-group">
                            <input type="text" ng-model="Model.firstName" class="form-control dash_user_inputs" id="first_name" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" ng-model="Model.lastName" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" ng-model="Model.email" class="form-control" id="email" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                           <input type="text" ng-model="Model.phNumber" class="form-control" id="home_phone" placeholder="Enter Home Phone Number">
                        </div>
                        <div class="form-group">
                            <input type="text" ng-model="Model.mobilePhone" class="form-control" id="mobile_phone" placeholder="Enter Mobile Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="facial_treatments">Facial Treatments</label>
                            <select multiple ng-model="facialTreatments" class="chosen-select">
                                <option value="Select treatment">Select a treatment</option>
                                <option value="Facial - 60 minutes for $50">Facial - 60 minutes for $50</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eye_treatments">Eye Treatments</label>
                            <select multiple ng-model="eyeTreatments" class="chosen-select" >
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
                            <select multiple ng-model="bodyTreatments" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="Full Body Massage - 60 minutes for $80">Full Body Massage - 60 minutes for $80</option>
                                <option value="Back, Neck and Shoulder - 30 minutes for $40">Back, Neck and Shoulder - 30 minutes for $40</option>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="spray_tanning">Spray Tanning</label>
                            <select multiple ng-model="sprayTanning" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="Full Body for $30">Full Body for $30</option>
                                <option value="Half Body for $20">Half Body for $20</option>
                            </select>                          
                        </div>
                        <div class="form-group">
                            <label for="nail_treatments">Nail Treatments</label>
                            <select multiple ng-model="nailTreatments" class="chosen-select">
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
                            <select multiple ng-model="waxingTreatments" class="chosen-select">
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
                            <select multiple ng-model="electrolysis" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="15 minutes (minimum appointment) for $25">15 minutes (minimum appointment) for $25</option>
                                <option value="30 minutes for $40">30 minutes for $40</option>
                            </select>   
                        </div>
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" placeholder="dd/mm/yyyy" required>
                        </div>
                    </form>
                    <div class="form-group">
                        <label for="appointment_time">Appointment Time</label>                                                          
                        <timepicker ng-model="time" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                    </div>           
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

    <script type="text/ng-template" id="profileAppointmentModalContent.html" class="modal">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Your details</h3>
        </div>
        <div class="modal-body">
            <form>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" ng-model="Model.firstName" class="form-control" id="first_name" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" ng-model="Model.lastName" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" ng-model="Model.email" class="form-control" id="email" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label for="home_phone">Home Phone Number</label>
                            <input type="text" ng-model="Model.phNumber" class="form-control" id="home_phone" placeholder="Enter Home Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone">Mobile Phone Number</label>
                            <input type="text" ng-model="Model.mobilePhone" class="form-control" id="mobile_phone" placeholder="Enter Mobile Phone Number">
                        </div>
                </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
        </div>
    </script>

    <script type="text/ng-template" id="editAppointmentModalContent.html" class="modal">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
           <h2 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Appointment</h2>
        </div>

        <div class="modal-body">
            <div class="row">
           
                <div class="col-md-8">
                        {{appointment.eye_treatments}}   
                    
                    <form>
                        
                        <div class="form-group">
                            <label for="facial_treatments">Facial Treatments</label>
                            <select multiple ng-model="facialTreatments" class="chosen-select">
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
                            <select multiple ng-model="bodyTreatments" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="Full Body Massage - 60 minutes for $80">Full Body Massage - 60 minutes for $80</option>
                                <option value="Back, Neck and Shoulder - 30 minutes for $40">Back, Neck and Shoulder - 30 minutes for $40</option>
                            </select>  
                        </div>

                        <div class="form-group">
                            <label for="spray_tanning">Spray Tanning</label>
                            <select multiple ng-model="sprayTanning" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="Full Body for $30">Full Body for $30</option>
                                <option value="Half Body for $20">Half Body for $20</option>
                            </select>                          
                        </div>

                        <div class="form-group">
                            <label for="nail_treatments">Nail Treatments</label>
                            <select multiple ng-model="nailTreatments" class="chosen-select">
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
                            <select multiple ng-model="waxingTreatments" class="chosen-select">
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
                            <select multiple ng-model="electrolysis" class="chosen-select">
                                <option value="Select one or multiple treatments">Select a treatment</option>
                                <option value="15 minutes (minimum appointment) for $25">15 minutes (minimum appointment) for $25</option>
                                <option value="30 minutes for $40">30 minutes for $40</option>
                            </select>   
                        </div>

                        <div class="form-group">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" placeholder="dd/mm/yyyy" required>
                        </div>
                    </form>

                    <div class="form-group">
                        <label for="appointment_time">Appointment Time</label>                                                          
                        <timepicker ng-model="time" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
            <button class="btn btn-default form_submit" ng-click="ok()">OK</button>
            
            <button class="btn btn-default form_submit" ng-click="cancel()">Cancel</button>
        </div>
    </script>
    
    <script>
        var pageModel = <?php echo json_encode($pageModel); ?>;
        
    </script>
</div>




