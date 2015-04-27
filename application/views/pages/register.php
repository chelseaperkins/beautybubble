

<div class="row login_background">
    <div class="col-sm-0 col-md-3"></div>
    <div class="col-md-5 login_form_wrapper">
        
        <?php echo form_open(); ?>

        <h2>Register</h2>
        <hr class="message_heading">
        <div class="form-group">
            <?php echo form_label('Email Address', 'email'); ?><span class='pull-right validation_error'><?php echo form_error('email'); ?></span>
            <input type="text" name="email" for="email" value="" class="form-control"  required />
        </div>

        <div class="form-group">
            <?php echo form_label('Password', 'password'); ?><span class='pull-right validation_error'><?php echo form_error('password'); ?></span>
            <input type="password" name="password" value="" class="form-control" required />
        </div> 
        <div class="form-group">
            <?php echo form_label('Confirm Password', 'confirm_password'); ?><span class='pull-right validation_error'><?php echo form_error('passconf'); ?></span>
            <input type="password" name="passconf" value="" class="form-control" required />
        </div> 
        
        
        <div class="login_submit">
            <input name="submit" type="submit" value="submit" class="btn btn-default login_submit">

        </div>         
       
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-0 col-md-3"></div>

</div>