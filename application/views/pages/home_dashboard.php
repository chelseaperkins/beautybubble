<div class="dashbd_wrap" ng-app="beautyBubbleApp" ng-controller="AddEditCtrl">
    <div class="row dashbd_home_content">

        <div class="dashbd_home_text">
            <h1><strong><?php echo"DASHBOARD"; ?></strong></h1>
            <p><?php echo"Todays appointments"; ?></p>

            <div class="row">
                <div class="col-sm-4 col-md-4 text center">

                    <div class="dash_appointment_cell">
                        <a class="dash_dropdown_btn btn btn-white dropdown-toggle" data-toggle="dropdown"></a>
                        <div class="class-tile-menu-toggle btn-group">
                            <a name="class_tile_dropdown" class=" dash_dropdown_btn btn btn-white dropdown-toggle img-circle" data-toggle="dropdown"><b class="caret"></b></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a class="share-class"><span class="glyphicon glyphicon-plus-sign"></span>Add/Edit Appointment</a></li>
                                <li><a class="edit-class"><span class="glyphicon glyphicon-remove-sign"></span>Delete Appointment</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="dash_appointment_cell">
                        <a class="dash_dropdown_btn btn btn-white dropdown-toggle" data-toggle="dropdown"></a>
                        <div class="class-tile-menu-toggle btn-group">
                            <a name="class_tile_dropdown" class=" dash_dropdown_btn btn btn-white dropdown-toggle img-circle" data-toggle="dropdown"><b class="caret"></b></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a class="share-class"><span class="glyphicon glyphicon-plus-sign"></span>Add/Edit Appointment</a></li>
                                <li><a class="edit-class"><span class="glyphicon glyphicon-remove-sign"></span>Delete Appointment</a></li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-4 col-md-4">
                    <div class="dash_appointment_cell">
                        <a class="dash_dropdown_btn btn btn-white dropdown-toggle" data-toggle="dropdown"></a>
                        <div class="class-tile-menu-toggle btn-group">
                            <a name="class_tile_dropdown" class=" dash_dropdown_btn btn btn-white dropdown-toggle img-circle" data-toggle="dropdown"><b class="caret"></b></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a class="share-class"><span class="glyphicon glyphicon-plus-sign"></span>Add/Edit Appointment</a></li>
                                <li><a class="edit-class"><span class="glyphicon glyphicon-remove-sign"></span>Delete Appointment</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="dash_appointment_cell">

                    </div>
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
        

            <div class="edit-class"><div class="edit-class-title"><h2>Add/Edit Appointment</h2></div>
                <div class="edit-appoinment"><p></p></div>
            </div>

            <div class="col-sm-12"></div>
            <div class="navbar-underline">
                <ul class="nav navbar-nav navbar-center special-edit-class-nav-for-ie"><li class="active"><a href="#">
                            <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
                    <li class=""><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></li>
                    <li class=""><a href="#"><span class="glyphicon glyphicon-remove-sign"></span> Delete</a></li>
                </ul>
            </div>
        </div>
        <div class="add-class-students">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8"><h2>Add appointment</h2>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="First name">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control input-lg" placeholder="Last name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Mobile phone number">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Phone number">
                            </div>

                            <div class="form-group">
                                <label for="facial_treatments"><?php echo"Facial Treatments"; ?></label>
                                <select multiple ng-model="facialTreatments" chosen style="width:100%;">
                                    <option value="Select treatment"><?php echo"Select a treatment"; ?></option>
                                    <option value="Facial - 60 minutes for $50"><?php echo"Facial - 60 minutes for $50"; ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="eye_treatments"><?php echo"Eye Treatments"; ?></label>

                                <select multiple ng-model="eyeTreatments" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="Eyelash Tint for $15"><?php echo"Eyelash Tint for $15"; ?></option>
                                    <option value="Eyebrow Tint for $10"><?php echo"Eyebrow Tint for $10"; ?></option>
                                    <option value="Eyebrow Tint and Lash Tint for $20"><?php echo"Eyebrow Tint and Lash Tint for $20"; ?></option>
                                    <option value="Eyebrow Shape and Brow Tint for $15"><?php echo"Eyebrow Shape and Brow Tint for $15"; ?></option>
                                    <option value="Eyebrow Tint, Shape and Lash Tint for $25"><?php echo"Eyebrow Tint, Shape and Lash Tint for $25"; ?></option>
                                    <option value="Eyebrow Perm for $30"><?php echo"Eyebrow Perm for $30"; ?></option>
                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="body_treatments"><?php echo"Body Treatments"; ?></label>
                                <select multiple ng-model="bodyTreatments" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="Full Body Massage - 60 minutes for $80"><?php echo"Full Body Massage - 60 minutes for $80"; ?></option>
                                    <option value="Back, Neck and Shoulder - 30 minutes for $40"><?php echo"Back, Neck and Shoulder - 30 minutes for $40"; ?></option>
                                </select>  
                            </div>



                            <div class="form-group">
                                <label for="spray_tanning"><?php echo"Spray Tanning"; ?></label>
                                <select multiple ng-model="sprayTanning" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="Full Body for $30"><?php echo"Full Body for $30"; ?></option>
                                    <option value="Half Body for $20"><?php echo"Half Body for $20"; ?></option>
                                </select>                          
                            </div>



                            <div class="form-group">
                                <label for="nail_treatments"><?php echo"Nail Treatments"; ?></label>
                                <select multiple ng-model="nailTreatments" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="Deluxe Manicure - 60 minutes for $45"><?php echo"Deluxe Manicure - 60 minutes for $45"; ?></option>
                                    <option value="Mini Manicure - 30 minutes for $30"><?php echo"Mini Manicure - 30 minutes for $30"; ?></option>
                                    <option value="File and Polish for $15"><?php echo"File and Polish for $15"; ?></option>
                                    <option value="Deluxe Pedicure - 60 minutes for $50"><?php echo"Deluxe Pedicure - 60 minutes for $50"; ?></option>
                                    <option value="Mini Pedicure - 30 minutes for $35"><?php echo"Mini Pedicure - 30 minutes for $35"; ?></option>
                                    <option value="Shallac Gel Polish Removel for $10"><?php echo"Shallac Gel Polish Removel for $10"; ?></option>
                                </select>

                            </div>


                            <div class="form-group">
                                <label for="waxing_treatments"><?php echo"Waxing Treatments"; ?></label>
                                <select multiple ng-model="waxingTreatments" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="Underarm wax for $15"><?php echo"Underarm wax for $15"; ?></option>
                                    <option value="Forearm wax for $20"><?php echo"Forearm wax for $20"; ?></option>
                                    <option value="Back or Chest wax for $35"><?php echo"Back or Chest wax for $35"; ?></option>
                                    <option value="1/2 Leg wax for $20"><?php echo"1/2 Leg wax for $20"; ?></option>
                                    <option value="Full leg wax for $30"><?php echo"Full leg wax for $30"; ?></option>
                                    <option value="Bikini wax for $20"><?php echo"Bikini wax for $20"; ?></option>
                                    <option value="Extended Bikini wax for $25"><?php echo"Extended Bikini wax for $25"; ?></option>
                                    <option value="Full Leg & Bikini wax for $30"><?php echo"Full Leg & Bikini wax for $30"; ?></option>
                                    <option value="Full Leg & Bikini & underarm wax for $50"><?php echo"Full Leg & Bikini & underarm wax for $50"; ?></option>
                                    <option value="Half leg & Bikini wax for $30"><?php echo"Half leg & Bikini wax for $30"; ?></option>
                                    <option value="Half Leg  & Bikini & underarm wax for $40"><?php echo"Half Leg  & Bikini & underarm wax for $40"; ?></option>
                                    <option value="Eyebrow shape for $10"><?php echo"Eyebrow shape for $10"; ?></option>
                                    <option value="Brazilian wax for $35"><?php echo"Brazilian wax for $35"; ?></option>
                                    <option value="Upper lip or chin for $10"><?php echo"Upper lip or chin for $10"; ?></option>
                                    <option value="Facial Bleaching $ 5 per area"><?php echo"Facial Bleaching $ 5 per area"; ?></option>
                                </select>                           
                            </div>

                            <div class="form-group">
                                <label for="electrolysis"><?php echo"Electrolysis"; ?></label>
                                <select multiple ng-model="electrolysis" chosen style="width:100%;">
                                    <option value="Select one or multiple treatments"><?php echo"Select a treatment"; ?></option>
                                    <option value="15 minutes (minimum appointment) for $25"><?php echo"15 minutes (minimum appointment) for $25"; ?></option>
                                    <option value="30 minutes for $40"><?php echo"30 minutes for $40"; ?></option>
                                </select>   
                            </div>

                            <div class="form-group">
                                <label for="appointment_date"><?php echo"Appointment Date"; ?></label>
                                <input type="date" class="form-control" id="appointment_date" placeholder="dd/mm/yyyy" required>
                            </div>
                        </form>

                        <div class="form-group">
                            <label for="appointment_time"><?php echo"Appointment Time"; ?></label>                                                          
                            <timepicker ng-model="time" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>



