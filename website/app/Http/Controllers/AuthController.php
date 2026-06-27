<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;


class AuthController extends Controller
{
    /**
     * ============================
     * REGISTER
     * ============================
     */
    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'password' => 'required|string|min:6',
        ]);


        $lastUser = User::latest('id')->lockForUpdate()->first();
        $nextId = $lastUser ? $lastUser->id + 1 : 1;

        $userCode = 'TN-26-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);


        $user = User::create([
            'user_id'      => $userCode,
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password'     => Hash::make($validated['password']),
            'is_guest_user'=> 0,
        ]);


        Auth::login($user);

       
        return redirect('/')
            ->with('type', 'success')
            ->with('message', 'Registration Successful! You are now logged in.');
    }

    /**
     * ============================
     * LOGIN
     * ============================
     */
    public function login(Request $request)
    {
        // ✅ Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // ✅ Attempt Login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 🔐 Prevent session fixation
            $request->session()->regenerate();

            return redirect('/')
                ->with('type', 'success')
                ->with('message', 'Login Successful! Welcome back.');
        }

        // ❌ Invalid login
        return back()
            ->with('type', 'error')
            ->with('message', 'Invalid email or password')
            ->withInput();
    }

    /**
     * ============================
     * LOGOUT
     * ============================
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔐 Destroy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('type', 'success')
            ->with('message', 'Logged out successfully!');
    }

//     public function sendOtp(Request $request)
// {
//     try {
//         $request->validate([
//             'email' => 'required|email|exists:users,email'
//         ]);

//         $email = $request->email;
//         $otp = rand(100000, 999999);

//         DB::table('password_reset_tokens')->updateOrInsert(
//             ['email' => $email],
//             [
//                 'token' => $otp,
//                 'created_at' => now()
//             ]
//         );

//         // 🔥 MAIL SEND
//         Mail::to($email)->send(new OtpMail($otp));

//         return response()->json([
//             'success' => true,
//             'message' => 'OTP sent successfully'
//         ]);

//     } catch (\Exception $e) {

//         \Log::error("OTP ERROR: ".$e->getMessage());

//         return response()->json([
//             'success' => false,
//             'message' => 'Mail send failed: '.$e->getMessage()
//         ]);
//     }
// }

    //    public function sendOtp(Request $request)
    // {
    //     $request->validate(['email' => 'required|email|exists:users,email']);

    //     $email = $request->email;
    //     $otp = rand(100000, 999999);

    //     // Store OTP in password_reset_tokens table
    //     // We'll use the table created by default Laravel migration
    //     DB::table('password_reset_tokens')->updateOrInsert(
    //         ['email' => $email],
    //         [
    //             'token' => $otp, // Storing raw OTP for simplicity as per request requirement "Send OTP"
    //             'created_at' => Carbon::now()
    //         ]
    //     );

    //     // Send OTP via Email
    //     try {
    //         Mail::to($email)->send(new OtpMail($otp));
    //     } catch (\Exception $e) {
    //         \Log::error('OTP Mail Error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to send OTP. Please check your mail configuration.'
    //         ], 500);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'OTP sent to your email.'
    //     ]);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'otp' => 'required'
    //     ]);

    //     $record = DB::table('password_reset_tokens')
    //                 ->where('email', $request->email)
    //                 ->where('token', $request->otp)
    //                 ->first();

    //     if ($record) {
    //         // Check expiry (e.g., 15 mins)
    //         if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
    //              return response()->json(['success' => false, 'message' => 'OTP expired. Please request a new one.'], 400);
    //         }

    //         return response()->json(['success' => true, 'message' => 'OTP verified.']);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 400);
    // }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     // Verify OTP again just to be safe or rely on client flow (better to use a token exchange, but request is simple)
    //     // Ideally we should have a token from verifyOtp step.
    //     // But for this simplified flow, we'll assume the client is honest or we check the token again if passed.
    //     // Let's check token again if user passes it, or just update if we trust the UI flow?
    //     // Let's require OTP again to prevent direct API attack.

    //     /*
    //        Actually, the safer way is verifyOtp returns a temporary token,
    //        but simpler way fits the prompt requirements: "After OTP verification: Allow user to set New Password."
    //     */

    //     $user = User::where('email', $request->email)->first();
    //     if (!$user) {
    //         return response()->json(['success' => false, 'message' => 'User not found.'], 404);
    //     }

    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Delete token
    //     DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Password updated successfully.',
    //         'redirect' => route('shop') // Or just close modal
    //     ]);
    // }

    //   public function sendOtp(Request $request)
    // {
    //     try {

    //         // ✅ VALIDATION (FIXED)
    //         $request->validate([
    //             'email' => 'required|email'
    //         ]);

    //         // ✅ CHECK USER EXISTS (CUSTOM)
    //         $user = User::where('email', $request->email)->first();

    //         if (!$user) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Email not registered'
    //             ]);
    //         }

    //         $email = $request->email;
    //         $otp = rand(100000, 999999);

    //         // ✅ STORE OTP
    //         DB::table('password_reset_tokens')->updateOrInsert(
    //             ['email' => $email],
    //             [
    //                 'token' => $otp,
    //                 'created_at' => now()
    //             ]
    //         );

    //         // ✅ SEND MAIL
    //         Mail::to($email)->send(new OtpMail($otp));

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'OTP sent successfully'
    //         ]);

    //     } catch (\Exception $e) {

    //         \Log::error("OTP ERROR: " . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Mail send failed'
    //         ]);
    //     }
    // }
    public function sendOtp(Request $request)
{
    try {

        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $otp = rand(100000, 999999);

        // Store OTP
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'created_at' => now()
            ]
        );

        // Send Mail (NOW WILL WORK FOR ANY EMAIL)
        Mail::to($email)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully'
        ]);

    } catch (\Exception $e) {

        \Log::error("OTP ERROR: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Mail send failed'
        ]);
    }
}

    /**
     * ============================
     * VERIFY OTP
     * ============================
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        // ⏱ Expiry check (15 min)
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired'
            ]);
        }

        // ✅ SESSION SECURITY
        session([
            'otp_verified' => true,
            'otp_email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified'
        ]);
    }

    /**
     * ============================
     * RESET PASSWORD
     * ============================
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // 🔐 SECURITY CHECK
        if (!session('otp_verified') || session('otp_email') != $request->email) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized request'
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        // ✅ UPDATE PASSWORD
        $user->password = Hash::make($request->password);
        $user->save();

        // ✅ CLEANUP
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        session()->forget(['otp_verified', 'otp_email']);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    }

}
