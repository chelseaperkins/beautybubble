
<div class="login_background">
   
    <div class="login_form_wrapper">
        <form class="teacher_login_form" action="#" method="POST">
            <fieldset>
                <legend>Log in</legend>
                <label for="teacherName">Teacher name
                    <input id="teacher_name" type="text" name="teacherName" onblur="validateForTextOnly(this)"required="true" value="<?php echo $teacher->getTeacherName() ?>"></label>
                <br>
                <br>
                <label for="password">Password
                    <input id="password" type="password" name="password" required="true" value="<?php echo $teacher->getPassword() ?>"></label>
                <br>
                <br>
                <div class="login_submit">
                    <input name="submit" type="submit" value="Log in">
                    <?php
                  
                   if($error != ""){
                   
                        echo '<span>' . $error . '</span>';
                        
                        }
                    ?>
                    
                </div>         
                <br>
            </fieldset>
        </form>

    </div>
</div>