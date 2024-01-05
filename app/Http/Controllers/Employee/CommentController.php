<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TaskComment;
use App\Http\Requests\StoreTaskCommentRequest;
use App\Http\Requests\UpdateTaskCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskCommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        TaskComment::create($data);
        return redirect()->back()->with('success','Comment post successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function show(TaskComment $taskComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskComment $taskComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskCommentRequest  $request
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskCommentRequest $request, TaskComment $taskComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskComment $taskComment)
    {
        //
    }
}
