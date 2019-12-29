<?php

namespace App\Http\Controllers;

use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageTopicControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //menampilkan seluruh topic
    {
        $data = Topic::all();
        $count = 1;
        return view('manage.topic.index', compact('data', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //manmpilkan form untuk menambah topic
    {
        return view('manage.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //memasukkan dari inputan di form create topic ke dalam database
    {
        $request->validate([
            'topic' => ['required', 'string'],
        ]);
        DB::table('topics')->insert([

            'topic' => $request->topic,
            'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('Topic.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }  //ga ke pake

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  // masuk kedalam form edit topic
    {
        $data = Topic::where('id','=',$id)->first();
        return view('manage.topic.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'topic' => ['required', 'string'],
        ]);
        DB::table('topics')->where('id','=',$id)->update([

            'topic' => $request->topic,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('Topic.index'));
    } //hasil dari inputan akan di update dan dimasukkan kedalam dataase

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //mendelete topic yang hanya boleh admin saja
    {
        $data = Topic::find($id);
        $data->Delete();
        return redirect(route('Topic.index'));
    }
}
