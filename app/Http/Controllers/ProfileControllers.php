<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileControllers extends Controller
{
    public function viewprofile($id)  //menampilkan profile
    {
        $data = User::where('id', '=', $id)->first();

        return view('user.profile', compact('data'));
    }

    public function messagestore(Request $request)  //setelah mengisi kolom di textarea profile(message), maka akan langsung disimpan kedalam database table message
    {
        $request->validate([
            'message' => ['required', 'string'],
        ]);
        DB::table('messages')->insert([
            'receiver' => (int)$request->receiver,
            'sender' => Auth::user()->id,
            'message' => $request->message,
            'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        return redirect('/');
    }

    public function viewmessage($id)  //menampilkan seluruh message
    {
        $data = Message::where('receiver', '=', $id)->paginate(10);

        return view('user.inbox', compact('data'));
    }

    public function destroymessage($id)  //delete message sesuai keinginan user
    {
        $data = Message::find($id);
        $data->Delete();
        return redirect('/MyQuestion/' . Auth::user()->id . '/viewmessage');
    }

    public function editprofile()  //edit profile sesuai user yang sekarang
    {
        $data = User::where('id', '=', Auth::user()->id)->first();
//        dd($data);
        return view('user.updateprofile', compact('data'));
    }

    public function updateprofile(Request $request)  //inputan dari form edit akan di update di database
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string','min:6', 'confirmed','alpha_num'],
            'gender' => ['required','string'],
            'address' => ['required'],
            'birthday' => ['required','date'],
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg'],
        ]);

        $request = Request();
        $profile = $request->file('photo');
        $profileName = time().'-'.$profile->getClientOriginalName();
        $destination = storage_path('app/public/users');
        $profile->move($destination,$profileName);

        DB::table('users')->where('id','=',Auth::user()->id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'photo' => $profileName,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect('MyQuestion/'.Auth::user()->id.'/viewprofile');
    }
}
