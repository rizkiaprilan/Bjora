<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageQuestionControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //menampilkan seluruh question yang ada, hanya admin yang bisa
    {
        $data = Question::paginate(10);
        $count = $data->firstItem();
        return view('manage.question.index', compact('data', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  //menampilkan form untuk menambahkan question
    {
        $topic = Topic::all();
        $user = User::all();
        return view('manage.question.create', compact('topic', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //memasukkan hasil inputan kedalam database
    {
        $request->validate([
            'question' => ['required'],
            'topic' => ['required'],
            'user' => ['required']

        ]);
        $name = User::where('id', '=', $request->user)->first();
        DB::table('questions')->insert([
            'question' => $request->question,
            'name' => $name->name,
            'user_id' => $request->user,
            'topic' => $request->topic,
            'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('Question.index'));


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
    }  //ga kepake

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //masuk ke dalam form edit question
    {
        $data = Question::where('id', '=', $id)->first();
        $topic = Topic::all();
        $user = User::all();
        return view('manage.question.edit', compact('data', 'topic', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  //hasil dari inputan yang ada di form edit akan di masukkan kedalam database
    {
        $request->validate([
            'question' => ['required'],
            'topic' => ['required'],
            'user' => ['required']

        ]);
        $name = User::where('id', '=', $id)->first();
        DB::table('questions')->insert([
            'question' => $request->question,
            'name' => $name->name,
            'user_id' => $request->user,
            'topic' => $request->topic,
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),

        ]);

        return redirect(route('Question.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //mendelete question yang ingin di hapus admin
    {
        $data = Question::find($id);
        $data->Delete();
        return redirect(route('Question.index'));
    }

    public function switchstatus($id)  //mengubah status pada question
    {

        $data = Question::where('id', '=', $id)->first();
        if ($data->status == 'open') {
            $data->update([
                'status' => 'close'
            ]);
        } else {
            $data->update([
                'status' => 'open'
            ]);
        }
        return redirect(route('Question.index'));
    }
}
