<!-- Modal -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iWay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form action="/partials/_handlelogin.php" method="POST">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPass" name="loginPass" required>
                    </div>
                    <div class="mb-3 form-check">
                        
                    <div class="g-recaptcha" data-sitekey="6LfltMIbAAAAAA5S3eXWUDMcM_rOC6J6hUnqc0RO" required>
                    </div>
                    <input type="submit" name="submit" value="submit" required>
                    
                    </div>
                    <!--<button type="submit" class="btn btn-primary">Submit</button> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<?php

if(isset($_POST['submit']))
{

function CheckCaptcha($userResponse) {
        $fields_string = '';
        $fields = array(
            'secret' => '',
            'response' => $userResponse
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }


    // Call the function CheckCaptcha
    $result = CheckCaptcha($_POST['g-recaptcha-response']);

    if ($result['success']) {
        //If the user has checked the Captcha box
        echo "Captcha verified Successfully";
	
    } else {
        // If the CAPTCHA box wasn't checked
       echo '<script>alert("Error Message");</script>';
    }
}
    ?>