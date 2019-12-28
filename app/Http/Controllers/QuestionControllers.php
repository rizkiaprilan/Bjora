<?php

namespace App\Http\Controllers;

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

        return redirect('/question');
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
    public function update(Request $request)
    {
        $request->validate([
            'question' => ['required'],
            'topic' => ['required']

        ]);

        DB::table('questions')->update([
            'question' => $request->question,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'topic' => $request->topic,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        return redirect('/question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data = Question::where('question', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%')->paginate(3);

        return view('question.index', [
            'data' => $data,
        ]);
    }
}
