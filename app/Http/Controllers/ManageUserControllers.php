<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUserControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //menampilkan seluruh user yang ada beserta CRUD nya
    {
        $data = User::paginate(10);
        $count = $data->firstItem();
        return view('manage.user.index', compact('data', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //menampilkan form add user berdasarkan admin
    {
        return view('manage.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //hasil inputan dari add user akan di masukkan kedalam database
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'alpha_num'],
            'gender' => ['required', 'string'],
            'address' => ['required'],
            'birthday' => ['required', 'date'],
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg'],
        ]);

        $profile = $request->file('photo');
        $profileName = time() . '-' . $profile->getClientOriginalName();
        $destination = storage_path('app/public/users');
        $profile->move($destination, $profileName);

        DB::table('users')->insert([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'photo' => $profileName,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('User.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    } //ga ke pake

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', '=', $id)->first();
//        dd($data);
        return view('manage.user.edit', compact('data'));
    } //masuk kedalam form edit, untuk mengubah user mana yang ingin di ubah

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'alpha_num'],
            'gender' => ['required', 'string'],
            'address' => ['required'],
            'birthday' => ['required', 'date'],
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg'],
        ]);

        $profile = $request->file('photo');
        $profileName = time() . '-' . $profile->getClientOriginalName();
        $destination = storage_path('app/public/users');
        $profile->move($destination, $profileName);

        DB::table('users')->where('id','=',$id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'photo' => $profileName,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('User.index'));
    } ////hasil inputan dari form edit akan di update di database

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
//        dd($data);
        $data->Delete();
        return redirect(route('User.index'));
    }  //menghapus user mana yang akan di hapus
}
