
<div class="row login_background">
   
    <div class="col-sm-0 col-md-3">
    </div>
    <div class= "col-md-5 login_form_wrapper">
        <?php echo form_open(); ?>

        <h2>Log in</h2>
        <hr class="message_heading">
        <div class="form-group">
            <?php echo form_label('Email Address', 'email'); ?><span class='error'><?php echo form_error('email'); ?></span>
            <input type="text" name="email" for="email" value="<?php echo set_value('email'); ?>" class="form-control" required />
        </div>

        <div class="form-group">
            <?php echo form_label('Password', 'password'); ?><span class='error'><?php echo form_error('password'); ?></span>
            <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" required />
        </div> 

        <div class="login_submit">
            <?php if(!isset($login_error)){ echo $login_error;} ?>
            <input name="submit" type="submit" value="Log-in" class="btn btn-default login_submit">
        </div>         

        <?php echo form_close(); ?>
        
    </div>
    <div class="col-sm-0 col-md-3"></div>
    
</div>