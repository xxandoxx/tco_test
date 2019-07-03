<?php

namespace App\Http\Controllers;

use App\Assign;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerTaskController extends Controller
{
    public function __construct()
    {
//        $this->middleware('AuthManager');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $data = [
            'listFree' => [],
            'list' => [],
            'status' => Task::STATUS
        ];
        foreach (User::getDevelopersList()->toArray() as $val) {
            $data['developers'][$val['id']] = $val;
        }

        foreach ($task->getManagerList()->get()->toArray() as $val) {
            if (empty($val['assign'])) {
                $data['listFree'][] = $val;
            } else {
                $data['list'][] = $val;
            }

        }
        return view('manager.task.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.task.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $data = $this->validatorCrate($request->all())->validate();

        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline'],
            'user_id' => auth()->user()->id,
            'status' => '1'
        ]);
        return redirect()->route('ManagerTask.index');
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
     * @return Assign
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validatorUpdate($request->all())->validate();
        //TODO ynenc anel vor nujn developer nujn tasky cheta

        Assign::create([
            'task_id' => $task->id,
            'developer_id' => $data['developer'],
            'manager_id' => auth()->user()->id,
            'status' => '1'
        ]);
        return redirect()->route('ManagerTask.index');
    }


    protected function validatorCrate(array $data)
    {

        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline' => ['required', 'date'],
        ]);
    }

    protected function validatorUpdate(array $data)
    {

        return Validator::make($data, [
            'developer' => ['required', 'integer'],
        ]);
    }
}
