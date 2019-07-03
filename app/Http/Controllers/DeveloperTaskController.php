<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DeveloperTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $data = [
            'list' => $task->getDeveloperList()->get()->toArray(),
            'status' => Task::STATUS
        ];
        foreach (User::getDevelopersList()->toArray() as $val) {
            $data['developers'][$val['id']] = $val;
        }
        return view('developer.task.index', $data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validatorUpdate($request->all())->validate();
        $task->status = $data['status'];
        $task->save();

        return redirect()->route('task.index');
    }


    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'status' => ['required', 'integer', Rule::in(array_keys(Task::STATUS))],
        ]);
    }
}
