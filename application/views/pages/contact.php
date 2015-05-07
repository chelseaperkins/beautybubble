<div class="under_nav_line"></div>
<div class="wrap">

    <div class="row contact_content contact_background">
        <div class="contact_text">

            <h2 class="page_heading"><strong><?php echo"Contact"; ?></strong></h2>
            <hr class="page_title">
            <br />
            <div class="row google_map_wrapper">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2890.40253429756!2d172.6132585!3d-43.577331199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d3220f19fd198ef%3A0xd5675afcff9d652c!2s36+Waiau+St%2C+Cracroft%2C+Christchurch+8025!5e0!3m2!1sen!2snz!4v1428282712745" width="100%" height="25%" frameborder="0"></iframe> 
            </div>
            <div class="row contact_details">
                <div class="col-sm-1 col-md-3 ">
                    <h3><strong><?php echo"Address"; ?></strong></h3>
                    <hr class="contact_heading">

                    <?php echo"The Beauty Bubble Beauty Therapy<br />
                                36 Waiau Street <br />
                                Cracroft <br />
                                Christchurch 8025 <br /> "; ?>

                </div>
                <div class="col-sm-1 col-md-3">
                    <h3><strong><?php echo"Contact details"; ?></strong></h3>
                    <hr class="contact_heading"> 

                    <p>
                        <?php echo"karina@beautybubble.co.nz"; ?> <br />
                        <?php echo"(03) 344 2245"; ?><br />
                        <?php echo"027 3810095"; ?>
                    </p>

                </div>
                <div class="col-sm-1 col-md-3">
                    <div>
                        <h3><strong><?php echo"Hours"; ?></strong></h3>
                        <hr class="contact_heading"> 
                        <?php echo"7 Days a week by appointment only"; ?>
                    </div>
                </div>
            </div>
            
                <div class="row contact_us_form">
                    
                    <div class="col-sm-0 col-md-3"></div>
                    <div class="col-sm-2 col-md-3">
                    <?php if (!$sent) : ?>
                        <div class="contact">
                            <h2><strong><?php echo"Send us a Message"; ?></strong></h2>
                            <hr class="message_heading">
                            <?php echo form_open(); ?>

                            <div class="form-group">
                                <?php echo form_label('First Name', 'first_name'); ?>
                                <?php echo form_input('first_name', set_value('first_name'), 'class=form-control'); ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo form_label('Last Name', 'last_name'); ?></label>
                                <?php echo form_input('last_name', set_value('last_name'), 'class=form-control'); ?>

                            </div>
                            <div class="form-group">
                                <?php echo form_label('Email Address', 'email_address'); ?>
                                <?php echo form_input('email_address', set_value('email_address'), 'class=form-control', 'required'); ?>

                            </div>


                            <div class="form-group">
                                <?php echo form_label('Comments', 'comments'); ?>
                                <textarea type="text" name="comments" class="form-control" rows="5" placeholder="Your Message" required></textarea><br />
                            </div>

                            <button type="submit" class="btn btn-default form_submit"><?php echo"Submit"; ?></button> 
                            <?php echo form_close(); ?>
                        </div>
                    <?php elseif ($sent) : ?>
                        <div class='contact_thank_message'>
                            <h2>Thank you for your message</h2>
                            <p>We will be in touch with you shortly.</p>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="col-sm-2 col-md-4 col-md-push-1">
                    <div class="fb-page" data-href="https://www.facebook.com/thebeautybubbleNZ" data-height="540" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/thebeautybubbleNZ"><a href="https://www.facebook.com/thebeautybubbleNZ">The Beauty Bubble</a></blockquote></div></div>
                </div>
                <div class="col-sm-0 col-md-2"></div>
            </div>
        </div>
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

