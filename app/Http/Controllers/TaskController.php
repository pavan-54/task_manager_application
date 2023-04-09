<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function add_task(Request $request){
        $request->validate([
            'taskname'=>'required',
            'taskdesc'=>'required'
        ]);

        $taskName = $request->taskname;

        $taskDesc = $request->taskdesc;

        $dueDate = $request->taskdate;

        $task = Task::create([
            'task_name' => $taskName,
            'task_description' => $taskDesc,
            'due_date' => $dueDate 
        ]);

        return back()->with('success','Task added Sucessfully');
    }
    public function mark_complete(Request $request,$id)
    {
        $task = new Task;

       

        $task->whereId($id)->update([
            "completed_on"=>today()
        ]);
        
        return redirect()->back()->with('success',"Task Marked as Complete");
    }

    public function mark_un_complete(Request $request,$id)
    {
        $task = new Task;

        $task->whereId($id)->update([
            "completed_on"=>null
        ]);
        
        return redirect()->back()->with('success',"Marked Un Complete");
    }
}
