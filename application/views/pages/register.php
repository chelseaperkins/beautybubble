

<div class="row login_background">
    <div class="col-sm-0 col-md-3"></div>
    <div class="col-md-5 login_form_wrapper">
        
        <?php echo form_open(); ?>
        
        <h2>Register</h2>
        <hr class="message_heading">
        <div class="form-group">
            <?php echo form_label('First Name', 'first_name'); ?><span class='pull-right validation_error'><?php echo form_error('first_name'); ?></span>
            <input type="text" name="first_name" for="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control"  required />
        </div>
        
        <div class="form-group">
            <?php echo form_label('Last Name', 'last_name'); ?><span class='pull-right validation_error'><?php echo form_error('last_name'); ?></span>
            <input type="text" name="last_name" for="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control"  required />
        </div>
        
        <div class="form-group">
            <?php echo form_label('Email Address', 'email'); ?><span class='pull-right validation_error'><?php echo form_error('email'); ?></span>
            <input type="text" name="email" for="email" value="<?php echo set_value('email'); ?>" class="form-control"  required />
        </div>

        <div class="form-group">
            <?php echo form_label('Password', 'password'); ?><span class='pull-right validation_error'><?php echo form_error('password'); ?></span>
            <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" required />
        </div> 
        <div class="form-group">
            <?php echo form_label('Confirm Password', 'confirm_password'); ?><span class='pull-right validation_error'><?php echo form_error('passconf'); ?></span>
            <input type="password" name="passconf" value="<?php echo set_value('confirm_password'); ?>" class="form-control" required />
        </div> 
        
        
        <div class="login_submit">
            <?phpif(isset(!$reg_error)){ echo $reg_error;}; ?>
            <input name="submit" type="submit" value="submit" class="btn btn-default login_submit">

        </div>         
       
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-0 col-md-3"></div>

</div>