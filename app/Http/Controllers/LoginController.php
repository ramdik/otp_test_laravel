<?php

namespace App\Http\Controllers;

use App\Helper\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Alert;

class LoginController extends Controller
{
    // Login section
    public function index()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        // cara validasi naynya validasi
        $this->validate($request, [
            'phone' => ['required', 'numeric']
        ]);

        // Menerima value input User dari form login
        $dataSession = $request->input();

        // searching dan ambil data dari database
        $dataPhone = DB::table('users')->where('phone', $dataSession['phone'])->get();

        // memanggil data DB
        foreach ($dataPhone as $phone) {
            $numb = $phone->phone;
            $name = $phone->name;
            $email = $phone->email;
        }
        // Mengecheck apakah nomor telpon User telah terdaftar di DB
        if (isset($numb)) {
            // Membuat session
            $dataSession = $request->input(); 
            $request->session()->put('phone', $dataSession['phone']);

            $OTPgenerate = new EmailHelper();
            $hashOTP = $OTPgenerate->generateNumberOTP();

            // Update otp kedalam field DB
            DB::table('users')->where('phone', $dataSession['phone'])->update([
                'otp' => Hash::make($hashOTP),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            Mail::to($email)->send(new SendMail($name, $hashOTP));

            return redirect('/verify');
        } else {
            return redirect('/login'); // ganti menggunakan pesan error
        }
    }

    

    public function verify(Request $request)
    {
        $session = $request->session()->get('phone');
        // ambil semua data user dari DB menggunakan eloquent 
        $users = Users::where('phone', $session)->get();
        // passing data user ke laman otp.blade (belum dipake)
        return view('otp', [
            'users' => $users
        ]);
    }

    public function verifyProcess(Request $request)
    {
        // Menerima value input otp dari User
        $requestInput = $request->input(['otp']);
        $dataSession = $request->session()->get('phone');

        // connect ke DB mencari record otp
        $users = Users::where('phone', $dataSession)->get();
        
        foreach ($users as $otpPass) {
            $passOTP = $otpPass->otp;
        }
        
        // cek apakah ada opt yg sama di DB
        if (Hash::check($requestInput, $passOTP)) {
            // ambil otp yg diinput user
            $dataSession = $request->input(); 

            // mengkosongkan otp yg telah direcord di DB
            Users::where('phone', $dataSession)->update(['otp' => NULL]);
            alert()->success('Login Berhasil','Selamat Anda Berhasil Login Dengan OTP.');
            return redirect('/');
        } else {
            return redirect()->back();
            // lalu tampilkan pesan error login gagal 'otp salah' pada UI
        }
    }


    // signup section
    public function signup()
    {
        return view('signup');
    }

    public function store(Request $request)
    {

        // membuat form validasi beserta rule validasi
        $this->validate($request, [
            'name' => 'required|string|min:4',
            'email' => 'required|email|min:5|unique:users,email',
            'phone' => 'required|numeric',
        ]);

        // cara insert data hasil input menggunakan DB eloquent
        Users::create($request->all());

        //redirect ke halaman login
        return view('login');
    }

}
