<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use DB;

use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;


trait BorrowDueEmailTrait
{
    public function sendDueReminderEmails(){
        // Due in 3 days
        $user_list = DB::table('borrowHistory')
                        ->select('user_id')
                        ->distinct()
                        ->where('due_at', date('Y-m-d', strtotime("+3 days")))
                        ->where('status', '1')
                        ->get();
        foreach($user_list as $user){
            $this->sendBorrowDueInThreeEmail($user->user_id);
        }
        $user_list = DB::table('borrowHistory')
                        ->select('user_id')
                        ->distinct()
                        ->where('due_at', date('Y-m-d', strtotime("+1 days")))
                        ->where('status', '1')
                        ->get();
        foreach($user_list as $user){
            $this->sendBorrowDueInOneEmail($user->user_id);
        }
        $user_list = DB::table('borrowHistory')
                        ->select('user_id')
                        ->distinct()
                        ->where('due_at', '<', date('Y-m-d'))
                        ->where('status', '1')
                        ->get();
        foreach($user_list as $user){
            $this->sendBorrowOverdueEmail($user->user_id);
        }
    }

    /**
     * Send email to remind due in 3 days
     * 
     * @return null
     */
    public function sendBorrowDueInThreeEmail($user_id){
        // get borrow information
        $borrowHistory = DB::table('borrowHistory')
            ->select('books.ISBN', 'books.title', 'borrowHistory.material_no', 'users.username', 'users.email',
            'borrowHistory.borrowed_at', 'borrowHistory.due_at')
            ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
            ->join('users', 'borrowHistory.user_id', '=', 'users.user_id')
            ->where('borrowHistory.user_id', '=', $user_id)
            ->where('due_at', date('Y-m-d', strtotime("+3 days")))
            ->where('status', '1')
            ->get();

        // email Body
        $emailBody = $this->composeDueSoonEmailBody($borrowHistory);
        // send Email
        $this->sendEmail($borrowHistory[0]->email, "Book Returns Due in 3 Days ", $emailBody);
    }

    /**
     * Send email to remind due in 1 day
     * 
     * @return null
     */
    public function sendBorrowDueInOneEmail($user_id){
        // get borrow information
        $borrowHistory = DB::table('borrowHistory')
            ->select('books.ISBN', 'books.title', 'borrowHistory.material_no', 'users.username', 'users.email',
            'borrowHistory.borrowed_at', 'borrowHistory.due_at')
            ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
            ->join('users', 'borrowHistory.user_id', '=', 'users.user_id')
            ->where('borrowHistory.user_id', '=', $user_id)
            ->where('due_at', date('Y-m-d', strtotime("+1 days")))
            ->where('status', '1')
            ->get();

        // email Body
        $emailBody = $this->composeDueSoonEmailBody($borrowHistory);
        // send Email
        $this->sendEmail($borrowHistory[0]->email, "Book Returns Due Tomorrow ", $emailBody);
    }

    /**
     * Send email for overdue reminder
     * 
     * @return null
     */
    public function sendBorrowOverdueEmail($user_id){
        // get borrow information
        $borrowHistory = DB::table('borrowHistory')
            ->select('books.ISBN', 'books.title', 'borrowHistory.material_no', 'users.username', 'users.email',
            'borrowHistory.borrowed_at', 'borrowHistory.due_at')
            ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
            ->join('users', 'borrowHistory.user_id', '=', 'users.user_id')
            ->where('borrowHistory.user_id', '=', $user_id)
            ->where('due_at', '<', date('Y-m-d'))
            ->where('status', '1')
            ->get();

        // email Body
        $emailBody = $this->composeOverdueEmailBody($borrowHistory);
        // send Email
        $this->sendEmail($borrowHistory[0]->email, "Books Overdue ", $emailBody);
    }

    /**
     * Composes due Email Body HTML
     * 
     * @return String
     */
    public function composeDueSoonEmailBody($borrowHistorys){

        $emailBody  = '<div class="container" style="padding: 1rem; background-color: #FFFFFF;">
                        <p>The following books are due to be returned soon.</p>
                        <p>You are reminded to return these books within the due date listed below.</p>
                        <table style="border:1px solid;border-collapse:collapse;width:1080px;text-align:left">
                            <tbody>
                                <tr style = "background-color: #95A5A6;
                                font-size: 14px;
                                text-transform: uppercase;
                                letter-spacing: 0.03em;
                                padding-top: 12px;">
                                    <th style="border:1px solid">Username</th>
                                    <th style="border:1px solid">Book</th>
                                    <th style="border:1px solid">Material No</th>
                                    <th style="border:1px solid">Borrowed At</th>
                                    <th style="border:1px solid">Due At</th>
                                </tr>';

        foreach($borrowHistorys as $borrowHistory){
            // booking Info
            $emailBody .=  '<tr>
                                <td style="border:1px solid">' . $borrowHistory->username . '</td>
                                <td style="border:1px solid"> Title: ' . $borrowHistory->title .  '<br> ISBN: ' . $borrowHistory->ISBN . '</td>
                                <td style="border:1px solid"> Material No: ' . sprintf('%08d', $borrowHistory->material_no) . '</td>
                                <td style="border:1px solid">' . $borrowHistory->borrowed_at . '</td>
                                <td style="border:1px solid">' . $borrowHistory->due_at . '</td>
                            </tr>';
        }
            

        // closing email
        $emailBody .= '</tbody>
                        </table>
                        </div>
                        </br></br>
                        <p>Please continue using our Library Services!</p>
                        <p>Thank You.</p> </div>';

        return $emailBody;
    }

    /**
     * Composes overdue Email Body HTML
     * 
     * @return String
     */
    public function composeOverdueEmailBody($borrowHistorys){

        $emailBody  = '<div class="container" style="padding: 1rem; background-color: #FFFFFF;">
                        <p>The following books are overdue.</p>
                        <p>Your account will be locked from utilizing the libraries borrowing services until they have been returned.</p>
                        <table style="border:1px solid;border-collapse:collapse;width:1080px;text-align:left">
                            <tbody>
                                <tr style = "background-color: #95A5A6;
                                font-size: 14px;
                                text-transform: uppercase;
                                letter-spacing: 0.03em;
                                padding-top: 12px;">
                                    <th style="border:1px solid">Username</th>
                                    <th style="border:1px solid">Book</th>
                                    <th style="border:1px solid">Material No</th>
                                    <th style="border:1px solid">Borrowed At</th>
                                    <th style="border:1px solid">Due At</th>
                                </tr>';

        foreach($borrowHistorys as $borrowHistory){
            // booking Info
            $emailBody .=  '<tr>
                                <td style="border:1px solid">' . $borrowHistory->username . '</td>
                                <td style="border:1px solid"> Title: ' . $borrowHistory->title .  '<br> ISBN: ' . $borrowHistory->ISBN . '</td>
                                <td style="border:1px solid"> Material No: ' . sprintf('%08d', $borrowHistory->material_no) . '</td>
                                <td style="border:1px solid">' . $borrowHistory->borrowed_at . '</td>
                                <td style="border:1px solid">' . $borrowHistory->due_at . '</td>
                            </tr>';
        }
            

        // closing email
        $emailBody .= '</tbody>
                        </table>
                        </div>
                        </br></br>
                        <p>Thank You.</p> </div>';

        return $emailBody;
    }


    /**
     * Send Email Function
     * 
     * @return route
     */
    public function sendEmail($emailTo, $emailSubject, $emailBody) {
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

        $mail->Subject = $emailSubject . $emailTo;
        $mail->Body = $emailBody;
                                
        // only redirect for failure, success is handled by calling function
        if( !$mail->send() ) {
            return route('home');
        }
    }
}
