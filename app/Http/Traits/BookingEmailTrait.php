<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use DB;

use Milon\Barcode\DNS2D;
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;


trait BookingEmailTrait
{


    /**
     * Main Function to call send Email for Bookig Notification
     * 
     * @return null
     */
    public function sendBookingNotificationEmail($bookingID){
        // get booking information
        $bookingInfo = DB::table('bookings')
                ->select('bookings.booking_id', 'users.username', 'users.email', 'bookings.ISBN', 'bookings.material_no',
                'books.title', 'bookings.expire_at')
                ->join('books', 'bookings.ISBN', '=' ,'books.ISBN')
                ->join('users', 'bookings.user_id', '=' ,'users.user_id')
                ->where('bookings.booking_id', '=', $bookingID)
                ->first();

        // email Body
        $emailBody = $this->composeEmailBody($bookingInfo);
        // send Email
        $this->sendEmail($bookingInfo->email, $emailBody);
    }

    /**
     * Send Email Function
     * 
     * @return route
     */
    public function sendEmail($emailTo, $emailBody) {
        //require base_path("vendor/autoload.php");
        $mail = new PHPMailer();     // Passing `true` enables exceptions
 
        // Email server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.mailgun.org';             //  smtp host 
        $mail->SMTPAuth = true;
        $mail->Username = '';   //  sender username
        $mail->Password = '';       // sender password
        $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
        $mail->Port = 587;                         // port - 587/465

        $mail->setFrom('', 'Library');
        $mail->addAddress('simhk625@gmail.com');
        // can only send verified one now so hardcode
        $mail->addReplyTo('simhk625@gmail.com', 'sim');

        $mail->isHTML(true);                // Set email content format to HTML

        $mail->Subject = "Booking Notification " . $emailTo;
        $mail->Body = $emailBody;
                                
        // only redirect for failure, success is handled by calling function
        if( !$mail->send() ) {
            return route('home');
        }
    }


    /**
     * Composes Email Body HTML
     * 
     * @return String
     */
    public function composeEmailBody($bookingInfo){

        $emailBody  = '<div class="container" style="padding: 1rem; background-color: #FFFFFF;">
                        <p>Your Booking is now available to be Borrowed.</p>
                        <p>Please Proceed to the Library within the booking expiry date listed below.</p>
                        <table style="border:1px solid;width:600px;text-align:left">
                            <tbody>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Username</th>
                                    <th>Book</th>
                                    <th>Material No</th>
                                    <th>Expires At</th>
                                </tr>';

        // booking Info
        $emailBody .=  '<tr>
                            <td>' . sprintf('%08d', $bookingInfo->booking_id) . '</td>
                            <td>' . $bookingInfo->username . '</td>
                            <td> Title: ' . $bookingInfo->title .  '<br> ISBN: ' . $bookingInfo->ISBN . '</td>
                            <td> Material No: ' . $bookingInfo->material_no . '</td>
                            <td>' . $bookingInfo->expire_at . '</td>
                        </tr>';

        // closing email
        $emailBody .= '</tbody>
                        </table>
                        </div>
                        </br></br>
                        <p>Please continue using our Library Services!</p>
                        <p>Thank You.</p> </div>';

        return $emailBody;
    }

}
