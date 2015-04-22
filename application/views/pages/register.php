

<div class="row login_background">
   
    <div class="col-md-12 login_form_wrapper">
        <form class="login_form" action="#" method="POST">
            
                <h2>Register</h2>
                <hr class="message_heading">
                <div class="form-group">
                <?php echo form_label('Email Address', 'email'); ?>
                <?php echo form_input('email', set_value('email'), 'class=form-control', 'required'); ?>
                </div>
                
                <div class="form-group">
                    <?php echo form_label('Password', 'password'); ?>
                            <?php echo form_input('password', set_value('password'), 'class=form-control', 'required'); ?>
                
                
                <div class="login_submit">
                    <input name="submit" type="submit" value="submit" class="btn btn-default login_submit">
                    
                </div>         
                
           
        </form>

    </div>
</div>