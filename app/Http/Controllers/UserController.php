<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $code = generateDigitCode();

        $user = DB::table('users')
            ->where('username', '=', $username)
            ->first();

        if ($user) {
            alert()->error('Account already exists', 'A user with the same username ' . $username . ' already exists.');
        } else {
            // Insert into 'users' table
            $id = DB::table('users')
                ->insertGetId([
                    'id' => generateuuid(),
                    'username' => $username,
                    'password' => $password,
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,

                ]);

            // Construct full name
            $full_name = $first_name;
            if (!empty($middle_name)) {
                $full_name .= ' ' . $middle_name;
            }
            $full_name .= ' ' . $last_name;

            // Insert into 'users_personal_information' table
            // DB::table('users')
            //     ->insert([
            //         'id' => $id,
            //         'username' => $username,
            //         'password' => $password,
            //         'first_name' => $first_name,
            //         'middle_name' => $middle_name,
            //         'last_name' => $last_name,
            //     ]);

            // // Send email to the user
            // $emailSubject = 'MCM EyeCafe Registration';
            // $emailContent = 'Welcome to MCM EyeCafe. To login, use your email address and the following temporary password ' . $code . '.';
            // $emailTo = $email;

            // sendEmail($emailSubject, $emailContent, $emailTo);

            alert()->success('User successfully registered.', 'To confirm the validity of your account, your temporary password was sent to your email address ' . $request->email);
        }

        return redirect()->action([MainController::class, 'main']);
    }

    // public function verify($code)
    // {
    //     $user = DB::table('users')
    //     ->where('email_activation_code', '=', $code)
    //     ->first();

    //     if($user){
    //         if($user->is_verified == '0'){
    //             DB::table('users')
    //             ->where('email_activation_code', '=', $code)
    //             ->update([
    //                 'date_verified' => Carbon::now(),
    //                 'is_verified' => '1'
    //             ]);

    //             $user = DB::table('users')
    //             ->where('email_activation_code', '=', $code)
    //             ->first();

    //             resetUserLoginCounter($user->email);
    //             setUserSessionVariables($user);
    //             return redirect()->action([AdminController::class, 'welcome']);
    //         }else{
    //             alert()->error('User is already verified','This user has already been verified. Please login to continue.');
    //             return redirect()->action([MainController::class, 'main']);
    //         }
    //     }else{
    //         alert()->error('Invalid Verification Code','Invalid user verification code.');
    //         return redirect()->action([MainController::class, 'main']);
    //     }
    // }

    // public function updatePassword(Request $request)
    // {
    //     $password1 = $request->password1;
    //     $password2 = $request->password2;
    //     $uuid = session('uuid');

    //     if($password1 == $password2){
    //         DB::table('users')
    //         ->where('uuid', '=', $uuid)
    //         ->update([
    //             'password' => md5($password1)
    //         ]);

    //         alert()->info('Success','Your password was successfully changed.');
    //         return redirect()->action([AdminController::class, 'home']);
    //     }else{
    //         DB::table('users')
    //         ->where('uuid', '=', $uuid)
    //         ->update([
    //             'password' => md5($password1)
    //         ]);

    //         alert()->error('Password Not Changed','Password did not match!');
    //         return redirect()->back();
    //     }
    // }

    // public function forgotPassword(Request $request)
    // {
    //     $email = $request->email;
    //     $code = generateDigitCode();

    //     DB::table('users')
    //     ->where('email','=',$email)
    //     ->update([
    //         'password_reset_code' => $code,
    //         'password_reset_allowed' => '1'
    //     ]);

    //     $reset_url = env('APP_URL') . '/user/reset/' . $code;
    //     $emailSubject = 'GRIND password reset';
    //     $emailContent = 'To reset you password, please go to the following link: ' . $reset_url . '.';
    //     $emailTo = $email;

    //     sendEmail($emailSubject,$emailContent,$emailTo);

    //     alert()->info('Check Your E-mail','An e-mail password reset link has been sent to ' . $email . '. Please login to your e-mail to complete the password reset process.');
    //     return redirect()->action([MainController::class, 'main']);
    // }

    // public function reset($uuid)
    // {
    //     $code = generateDigitCode();

    //     $user = DB::table('users')
    //     ->where('uuid','=',$uuid)
    //     ->first();

    //     $email = $user->email;

    //     DB::table('users')
    //     ->where('uuid', '=', $uuid)
    //     ->update([
    //         'password' => md5($code),
    //         'code' => $code
    //     ]);

    //     $emailSubject = 'Infinit SMS password reset';
    //     $emailContent = 'An administrator has reset your password. Your new password is ' . $code . '.';
    //     $emailTo = $email;

    //     sendEmail($emailSubject,$emailContent,$emailTo);

    //     alert()->info('Password has been reset','A new password has been generated and sent to ' . $email . '.');
    //     return redirect()->action([UserController::class, 'active']);
    // }

    public function update(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $password = $request->password;

        DB::table('users')
            ->where('id', '=', $id)
            ->update([
                'username' => $username,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'password' => $password,
                'date_modified' => Carbon::now()
            ]);

        $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();

        setUserSessionVariables($user);

        alert()->success('Success', 'User information has been updated.');
        return redirect()->action([AdminController::class, 'home']);
    }

    public function updatePassword2(Request $request)
    {
        $current_password = $request->current_password;
        $new_password1 = $request->new_password1;
        $new_password2 = $request->new_password2;

        $user = DB::table('users')
        ->where('id', '=', session('id'))
        ->first();

        // if(md5($current_password) == $user->password){
        //     if($new_password1 == $new_password2){

        //         DB::table('users')
        //         ->where('id','=',session('id'))
        //         ->update([
        //             'password' => md5($new_password1)
        //         ]);

        //         alert()->success('Success','User password has been changed.');
        //     }else{
        //         alert()->warning('Warning','Password did not matched.');
        //     }
        // }else{
        //     alert()->warning('Warning','Incorrect user password.');
        // }
        return redirect()->action([AdminController::class, 'home']);
    }

    // public function active()
    // {
    //     $mode = 'active';

    //     $users = DB::table('users')
    //     ->where('active','=','1')
    //     ->where('acc_id','=',session('acc_id'))
    //     ->orderby('last_name')
    //     ->orderby('first_name')
    //     ->get();

    //     return view('admin.users.current', compact('users','mode'));
    // }

    // public function inactive()
    // {
    //     $mode = 'inactive';

    //     $users = DB::table('users')
    //     ->where('active','=','0')
    //     ->where('acc_id','=',session('acc_id'))
    //     ->orderby('last_name')
    //     ->orderby('first_name')
    //     ->get();

    //     return view('admin.users.current', compact('users','mode'));
    // }

    // public function activate($uuid)
    // {
    //     DB::table('users')
    //     ->where('uuid','=',$uuid)
    //     ->update([
    //         'active' => '1'
    //     ]);

    //     alert()->success('Success','User has been activated.');
    //     return redirect()->back();
    // }

    // public function deactivate($uuid)
    // {
    //     DB::table('users')
    //     ->where('uuid','=',$uuid)
    //     ->update([
    //         'active' => '0'
    //     ]);

    //     alert()->success('Success','User has been deactivated.');
    //     return redirect()->back();
    // }

    // public function addAdmin($uuid)
    // {
    //     DB::table('users')
    //     ->where('uuid','=',$uuid)
    //     ->update([
    //         'is_admin' => '1'
    //     ]);

    //     alert()->success('Success','User has been set as admin.');
    //     return redirect()->back();
    // }

    // public function removeAdmin($uuid)
    // {
    //     DB::table('users')
    //     ->where('uuid','=',$uuid)
    //     ->update([
    //         'is_admin' => '0'
    //     ]);

    //     alert()->success('Success','User has been set as regular user.');
    //     return redirect()->back();
    // }


}
