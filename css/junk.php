// $("#contact-form").on("submit", function(e){
    //     if(!e.isDefaultPrevented()){
    //         let url ="contact.php";
    //         $.ajax({
    //             type:"POST",
    //             url: url,
    //             data: $(this).serialize(),
    //             success: function(data){
    //                  // we recieve the type of the message: success x danger and apply it to the 
    //                  let messageAlert = `alert ${data.type}`;
    //                  let messageText = data.message;
    //                  let alertBox = `<div class="alert ${messageAlert} alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> ${messageText} </div>`;
    //                     //Display the message that was returned
    //                  if (messageAlert && messageText) {
    //                     // inject the alert to .messages div in our form
    //                     $('#contact-form').find('.messages').html(alertBox);
    //                     // empty the form
    //                     $('#contact-form')[0].reset();
    //                 }
    //             }
    //         });
    //         return false;
    //     }
    // });

        // Select all links with hashes

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$from = $_POST['email'];

$Sendto = 'admin@fastrak.com.ng';

$subject = 'Subject of the mail';

$fields = array('name' => 'Name',
                'email' => 'email',
                'phone' => 'Phone',
                'subject' => 'Subject',
                'message' => 'Message',
            );

$okMessage = 'Contact form submitted successfully. We\'ll get back to you soon.';

$errMessage = 'There was an error submitting your message, please try again later.';

try{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
    $emailTextHtml = "<h1>New message from website contact form</h1><hr>";
    $emailTextHtml .= "<table>";
    
    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }
    $emailTextHtml .= "</table><hr>";
    $emailTextHtml .= "<p>Have a nice day,<br>Best,<br>Ondrej</p>";
    
    $mail = new PHPMailer;

    $mail->setFrom($fromEmail);
    $mail->addAddress($sendToEmail); // add more addresses by simply adding another line with $mail->addAddress();
    $mail->addReplyTo($from);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->msgHTML($emailTextHtml);
    if(!$mail->send()) {
        throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
    }

    $responseArray = array('type' => 'success', 'message' => $okMessage);

}catch(\Exception $e){
    $responseArray = array('type' => 'danger', 'message' =>$errMessage);
}

// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}