<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Question::paginate(10);
        return view('question.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Topic::all();
        return view('question.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => ['required'],
            'topic' => ['required']

        ]);

        DB::table('questions')->insert([
            'question' => $request->question,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'topic' => $request->topic,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Question::where('user_id','=',$id)->paginate(10);
        return view('question.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Question::where('id','=',$id)->first();
        $topic = Topic::all();

        return view('question.edit',compact('data','topic'));
    }

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
            'question' => ['required'],
            'topic' => ['required']

        ]);

        DB::table('questions')->where('id','=',$id)->update([
            'question' => $request->question,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'topic' => $request->topic,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        return redirect('/MyQuestion/'.Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Question::find($id);
        $data->Delete();
        return redirect('/MyQuestion/'.Auth::user()->id);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data = Question::where('question', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%')->paginate(3);

        return view('question.index', [
            'data' => $data,
        ]);
    }

    public function answer($id){
        $answer = Answer::where('question_id','=',$id)->get();
        $data = Question::where('id','=',$id)->first();
//        dd($answer);

        return view('question.answer', [
            'answer' => $answer,
            'data' => $data,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'answer' => ['required'],
        ]);

        DB::table('answers')->insert([
            'answer' => $request->answer,
            'question_id' => $request->questionId,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        return redirect('/MyQuestion/'.$request->questionId.'/answer');
    }

    public function destroyanswer($id)
    {
        $data = Answer::find($id);
        $dest = $data->question_id;
        $data->Delete();
        return redirect('/MyQuestion/'.$dest.'/answer');
    }

    public function switchstatus($id)
    {
        $data = Question::where('id','=',$id)->first();
        if ($data->status == 'open'){
            $data->update([
                'status'=>'close'
            ]);
        }else{
            $data->update([
                'status'=>'open'
            ]);
        }
        $dest = $data->id;

        return redirect('/MyQuestion/'.$dest.'/answer');
    }

}
