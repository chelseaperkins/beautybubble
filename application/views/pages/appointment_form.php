<div class="under_nav_line"></div>
<div ng-app="beautyBubbleApp" ng-controller="AppointmentCtrl" class="wrap">


    <div class="row appointment_content appointment_background">
        <div class="appointment_text">

            <h2 class="page_heading"><strong><?php echo"Request Appointment"; ?></strong></h2>
            <hr class="page_title">
            <br />
            <div class="col-sm-0 col-md-2">

            </div>
            <div class="col-md-6">

                <div class="appointment">
                    <?php if (!empty($errors)): ?>
                        <ul class="errors">
                            <?php foreach ($errors as $error): ?>
                                <?php /* @var $error Error */ ?>
                                <li><?php echo $error->getMessage(); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php echo form_open_multipart(); ?>

                    <label><h3 class="appointment_form_heading"><strong><?php echo"Contact details"; ?></strong></h3></label>
                    <hr class="appointment_heading">

                    <div class="form-group">
                        <?php echo form_label('First Name', 'first_name'); ?>
                        <?php echo form_input('first_name', set_value('first_name'), 'class=form-control'); ?>
                    </div>

                    <div class="form-group">
                        <label><?php echo form_label('Last Name', 'last_name'); ?></label>
                        <?php echo form_input('Last Name', set_value('last_name'), 'class=form-control'); ?>

                    </div>
                    <div class="form-group">
                        <?php echo form_label('Email', 'email'); ?>
                        <?php echo form_input('Email', set_value('email'), 'class=form-control'); ?>

                    </div>

                    <div class="form-group">
                        <?php echo form_label('Phone Number', 'ph_number'); ?>
                        <?php echo form_input('Phone Number', set_value('ph_number'), 'class=form-control'); ?>                            
                    </div>

                    <div class="form-group">
                        <?php echo form_label('Mobile Number', 'mobile_number'); ?>
                        <?php echo form_input('Mobile Number', set_value('mobile_number'), 'class=form-control', 'placeholder="Enter Home Phone Number"'); ?>
                    </div>

                    <div class=" form-group">
                        <?php echo form_label('Remember Me', 'remember_me'); ?>
                        <input type="checkbox">                           
                    </div>

                    <label><h3 class="appointment_form_heading"><strong><?php echo"Appointment details"; ?></strong></h3></label>
                    <hr class="appointment_heading"> 

                    <div class="form-group">
                        <label for="facial_treatments"><?php echo"Facial Treatments"; ?></label>
                        <select name="facial_treatments" multiple ng-model="facialTreatments" chosen style="width:100%;">
                            <option value="Select treatment"><?php echo "Select a treatment"; ?></option>
                            <option value="Facial - 60 minutes for $50"><?php echo "Facial - 60 minutes for $50"; ?></option>
                        </select>

                    </div>


                    <div class="form-group">
                        <?php echo form_label('Eye Treatments', 'eye_treatments'); ?>
                        <select name="eye_treatments" multiple ng-model="eyeTreatments" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments"; ?></option>
                            <option value="Eyelash Tint for $15"><?php echo "Eyelash Tint for $15" ?></option>
                            <option value="Eyebrow Tint for $10"><?php echo "Eyebrow Tint for $10"; ?></option>
                            <option value="Eyebrow Tint and Lash Tint for $20"><?php echo "Eyebrow Tint and Lash Tint for $20"; ?></option>
                            <option value="Eyebrow Shape and Brow Tint for $15"><?php echo "Eyebrow Shape and Brow Tint for $15"; ?></option>
                            <option value="Eyebrow Tint, Shape and Lash Tint for $25"><?php echo "Eyebrow Tint, Shape and Lash Tint for $25"; ?></option>
                            <option value="Eyelash Perm for $30"><?php echo "Eyelash Perm for $30"; ?></option>
                        </select>
                    </div> 



                    <div class="form-group">
                        <?php echo form_label('Body Treatments', 'body_treatments'); ?>
                        <select name="body_treatments" multiple ng-model="bodyTreatments" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments" ?></option>
                            <option value="Full Body Massage - 60 minutes for $80"><?php echo "Full Body Massage - 60 minutes for $80"; ?></option>
                            <option value="Back, Neck and Shoulder - 30 minutes for $40"><?php echo "Back, Neck and Shoulder - 30 minutes for $40"; ?></option>
                        </select>  
                    </div>



                    <div class="form-group">
                        <?php echo form_label('Spray Tanning', 'spray_tanning'); ?>
                        <select name="spray_tanning" multiple ng-model="sprayTanning" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments"; ?></option>
                            <option value="Full Body for $30"><?php echo "Full Body for $30"; ?></option>
                            <option value="Half Body for $20"><?php echo "Half Body for $20"; ?></option>
                        </select>                          
                    </div>

                    <div class="form-group">
                        <?php echo form_label('Nail Treatments', 'nail_treatments'); ?>
                        <select name="nail_treatments" multiple ng-model="nailTreatments" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments"; ?></option>
                            <option value="Deluxe Manicure - 60 minutes for $45"><?php echo "Deluxe Manicure - 60 minutes for $45"; ?></option>
                            <option value="Mini Manicure - 30 minutes for $30"><?php echo "Mini Manicure - 30 minutes for $30"; ?></option>
                            <option value="File and Polish for $15"><?php echo "File and Polish for $15"; ?></option>
                            <option value="Deluxe Pedicure - 60 minutes for $50"><?php echo "Deluxe Pedicure - 60 minutes for $50"; ?></option>
                            <option value="Mini Pedicure - 30 minutes for $35"><?php echo "Mini Pedicure - 30 minutes for $35"; ?></option>
                            <option value="Shallac Gel Polish Removel for $10"><?php echo "Shallac Gel Polish Removel for $10"; ?></option>
                        </select>
                    </div>

                    <div class="form-group">

                        <?php echo form_label('Waxing Treatments', 'waxing_treatments'); ?>
                        <select name="waxing_treatments" multiple ng-model="waxingTreatments" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments"; ?></option>
                            <option value="Underarm wax for $15"><?php echo "Underarm wax for $15"; ?></option>
                            <option value="Forearm wax for $20"><?php echo "Forearm wax for $20"; ?></option>
                            <option value="Back or Chest wax for $35"><?php echo "Back or Chest wax for $35"; ?></option>
                            <option value="1/2 Leg wax for $20"><?php echo "1/2 Leg wax for $20"; ?></option>
                            <option value="Full leg wax for $30"><?php echo "Full leg wax for $30"; ?></option>
                            <option value="Bikini wax for $20"><?php echo "Bikini wax for $20"; ?></option>
                            <option value="Extended Bikini wax for $25"><?php echo "Extended Bikini wax for $25"; ?></option>
                            <option value="Full Leg & Bikini wax for $30"><?php echo "Full Leg & Bikini wax for $30"; ?></option>
                            <option value="Full Leg & Bikini & underarm wax for $50"><?php echo "Full Leg & Bikini & underarm wax for $50"; ?></option>
                            <option value="Half leg & Bikini wax for $30"><?php echo "Half leg & Bikini wax for $30"; ?></option>
                            <option value="Half Leg  & Bikini & underarm wax for $40"><?php echo "Half Leg  & Bikini & underarm wax for $40"; ?></option>
                            <option value="Eyebrow shape for $10"><?php echo "Eyebrow shape for $10"; ?></option>
                            <option value="Brazilian wax for $35"><?php echo "Brazilian wax for $35"; ?></option>
                            <option value="Upper lip or chin for $10"><?php echo "Upper lip or chin for $10"; ?></option>
                            <option value="Facial Bleaching $5 per area"><?php echo "Facial Bleaching $5 per area"; ?></option>
                        </select>                           
                    </div>

                    <div class="form-group">
                        <?php echo form_label('Electrolysis', 'electrolysis'); ?>
                        <select name="electrolysis" multiple ng-model="electrolysis" chosen style="width:100%;">
                            <option value="Select one or multiple treatments"><?php echo "Select one or multiple treatments"; ?></option>
                            <option value="15 minutes (minimum appointment) for $25"><?php echo "15 minutes (minimum appointment) for $25"; ?></option>
                            <option value="30 minutes for $40"><?php echo "30 minutes for $40"; ?></option>
                        </select> 
                    </div>

                    <div class="form-group">
                        <?php echo form_label('Appointment Date', 'date_time'); ?>
                        <input type="date" class="form-control" id="appointment_date" placeholder="dd/mm/yyyy" required>
                    </div>

                    <div class="form-group">
                        <?php echo form_label('Appointment Time', 'date_time'); ?>                                                          
                        <timepicker ng-model="time" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                    </div>                   

                    <?php echo form_submit('submit', 'Submit', 'class="btn btn-default form_submit"'); ?>

                    <div>
                    </div>
                    <?php echo form_close(); ?>
                </div>     
            </div>
        </div>
        <div class="col-sm-0 col-md-2">

        </div>
    </div>
</div>
<div class="row">
    <div class="call_to_action_wrap">
        <div class="call_to_action_line"></div>
        <div class="call_to_action_background">
            <div class="call_to_action_buttons">

            </div> 
        </div>
    </div>
</div>




