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

                <div class="appointment" ng-hide="isFormAccepted=true">
                    <?php if (!empty($errors)): ?>
                        <ul class="errors">
                            <?php foreach ($errors as $error): ?>
                                <?php /* @var $error Error */ ?>
                                <li><?php echo $error->getMessage(); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <form>
                        <label><h3 class="appointment_form_heading"><strong><?php echo"Contact details"; ?></strong></h3></label>
                        <hr class="appointment_heading">

                        <div class="form-group">
                            <label for="first_name"><?php echo"First Name"; ?></label>
                            <input type="text" ng-model="Model.firstName" class="form-control" id="first_name" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name"><?php echo"Last Name"; ?></label>
                            <input type="text" ng-model="Model.lastName" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo"Email Address"; ?></label>
                            <input type="email" ng-model="Model.email" class="form-control" id="email" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label for="home_phone"><?php echo"Home Phone Number"; ?></label>
                            <input type="text" ng-model="Model.phNumber" class="form-control" id="home_phone" placeholder="Enter Home Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone"><?php echo"Mobile Phone Number"; ?></label>
                            <input type="text" ng-model="Model.mobilePhone" class="form-control" id="mobile_phone" placeholder="Enter Mobile Phone Number">
                        </div>
                        
                        <label><h3 class="appointment_form_heading"><strong><?php echo"Appointment details"; ?></strong></h3></label>
                        <hr class="appointment_heading"> 

                        <div class="form-group">
                            <label for="facial_treatments"><?php echo"Facial Treatments"; ?></label>

                            <select multiple ng-model="Model.facialTreatments" chosen style="width:100%;">
                                <option value="Select treatment"><?php echo"Select a treatment"; ?></option>
                                <option value="Facial - 60 minutes for $50"><?php echo"Facial - 60 minutes for $50"; ?></option>
                            </select>

                        </div>


                        <div class="form-group">
                            <label for="eye_treatments"><?php echo"Eye Treatments"; ?></label>

                            <select multiple ng-model="Model.eyeTreatments" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
                                <option value="Eyelash Tint for $15"><?php echo"Eyelash Tint for $15"; ?></option>
                                <option value="Eyebrow Tint for $10"><?php echo"Eyebrow Tint for $10"; ?></option>
                                <option value="Eyebrow Tint and Lash Tint for $20"><?php echo"Eyebrow Tint and Lash Tint for $20"; ?></option>
                                <option value="Eyebrow Shape and Brow Tint for $15"><?php echo"Eyebrow Shape and Brow Tint for $15"; ?></option>
                                <option value="Eyebrow Tint, Shape and Lash Tint for $25"><?php echo"Eyebrow Tint, Shape and Lash Tint for $25"; ?></option>
                                <option value="Eyelash Perm for $30"><?php echo"Eyelash Perm for $30"; ?></option>
                            </select>
                        </div> 

                        <div class="form-group">
                            <label for="body_treatments"><?php echo"Body Treatments"; ?></label>
                            <select multiple ng-model="Model.bodyTreatments" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
                                <option value="Full Body Massage - 60 minutes for $80"><?php echo"Full Body Massage - 60 minutes for $80"; ?></option>
                                <option value="Back, Neck and Shoulder - 30 minutes for $40"><?php echo"Back, Neck and Shoulder - 30 minutes for $40"; ?></option>
                            </select>  
                        </div>

                        <div class="form-group">
                            <label for="spray_tanning"><?php echo"Spray Tanning"; ?></label>
                            <select multiple ng-model="Model.sprayTanning" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
                                <option value="Full Body for $30"><?php echo"Full Body for $30"; ?></option>
                                <option value="Half Body for $20"><?php echo"Half Body for $20"; ?></option>
                            </select>                          
                        </div>

                        <div class="form-group">
                            <label for="nail_treatments"><?php echo"Nail Treatments"; ?></label>
                            <select multiple ng-model="Model.nailTreatments" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
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
                            <select multiple ng-model="Model.waxingTreatments" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
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
                            <select multiple ng-model="Model.electrolysis" chosen style="width:100%;">
                                <option value="Select one or multiple treatments"><?php echo"Select one or multiple treatments"; ?></option>
                                <option value="15 minutes (minimum appointment) for $25"><?php echo"15 minutes (minimum appointment) for $25"; ?></option>
                                <option value="30 minutes for $40"><?php echo"30 minutes for $40"; ?></option>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="appointment_date"><?php echo"Appointment Date"; ?></label>
                            <p class="input-group">
                            <input type="text" ng-model="Model.dateTime"  class="form-control" id="appointment_date" datepicker-popup="dd-MMMM-yyyy" is-open="opened" min-date="minDate" max-date="maxDate" close-text="Close" required>
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="datePickerOpened($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                            </span>
                            </p>
                            
                        </div>

                        <div class="form-group">
                            <label for="appointment_time"><?php echo"Appointment Time"; ?></label>                                                          
                            <timepicker ng-model="Model.dateTime" hour-step="1" minute-step="15" show-meridian="true" mousewheel="true" required></timepicker>
                        </div>

                        <div
                        vc-recaptcha
                        key="'6LeSoAUTAAAAAO8g18bu-iyKnFnZATMhj-oa-Q6q'"
                        on-success="setResponse(response)"
                        ></div>
                        <br />

                        <input type="button" ng-click="sendData()" ng-disabled="!isVerified || isSending" value="Submit" class="btn btn-default form_submit">
                        {{emailSendErrorMessage}}

                    </form>
                </div>
                <div class="appointmentsuccess" ng-show="isFormAccepted">
                    <h3>Thank you for your appointment request!</h3><br />
                    <p>Please remember that this is just a request for an appointment, and will need to be confirmed.<br /> We will be in touch with you shortly.</p><br />
                    <p>Your requested appointment date and time is: {{Model.dateTime | date:'dd MMMM hh:mm a' }}</p>
                    <p>The treatments you requested are:</p>
                    <table class="appointmentsuccess">
                    <tr ng-hide="Model.facialTreatments == null || Model.facialTreatments.length == 0">
                        <td>Facial Treatments:</td>
                        <td><div ng-repeat="treatment in Model.facialTreatments">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.eyeTreatments == null || Model.eyeTreatments.length == 0">
                        <td>Eye Treatments:</td>
                        <td><div ng-repeat="treatment in Model.eyeTreatments">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.bodyTreatments == null || Model.bodyTreatments.length == 0">
                        <td>Body Treatments:</td>
                        <td><div ng-repeat="treatment in Model.bodyTreatments">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.sprayTanning == null || Model.sprayTanning.length == 0">
                        <td>Spray Tanning:</td>
                        <td><div ng-repeat="treatment in Model.sprayTanning">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.nailTreatments == null || Model.nailTreatments.length == 0">
                        <td>Nail Treatments:</td>
                        <td><div ng-repeat="treatment in Model.nailTreatments">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.waxingTreatments == null || Model.waxingTreatments.length == 0">
                        <td>Waxing Treatments:</td>
                        <td><div ng-repeat="treatment in Model.waxingTreatments">{{treatment}}</div></td>
                    </tr>
                    <tr ng-hide="Model.electrolysis == null || Model.electrolysis.length == 0">
                        <td>Electrolysis:</td>
                        <td><div ng-repeat="treatment in Model.electrolysis">{{treatment}}</div></td>
                    </tr>

                </table>
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




