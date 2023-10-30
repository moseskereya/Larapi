<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index(Request $request){
     return new TaskCollection(Task::paginate());
   }
    
   public function show(Request $request, Task $task){
     return new TaskResource($task);
   }

    public function store(Request $request){ 
        $validate = $request->validate(['title' => 'required|max:255']);
        $task = Task::create($validate);
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task){
      $validate = $request->validate(['title'=> 'required|max:255']);
      $task->update($validate);
      return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task){
      $task->delete();
      return new TaskResource($task);
    }

}
