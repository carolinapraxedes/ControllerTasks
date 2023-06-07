<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = auth()->user()->id;
        
        $task = Task::where('userID',$userID)->paginate(2);

        return view('task.index',['task'=>$task]);
        /*if(Auth::check()){
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;
            return "ID: $id | Name: $name | Email: $email";
        }else{
            return 'Você não está logado';
        }*/

       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =$request->all('task','dateEnd'); 
        //estou dizendo quais sao os atributos que serao recuperados
        $data['userID'] = auth()->user()->id;

        //dd($data);
        $task = task::create($data);
        
        $userEmail= auth()->user()->email; //email do usuario logado (autenticado)
        
        Mail::to($userEmail)->send(new NewTaskMail($task));
        return redirect()->route('task.show',['task'=>$task->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //dd($task);
        return view('task.show',['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $userID = auth()->user()->id;
        
        if($task->userID == $userID){
            return view('task.edit',['task'=>$task]);            
        }
        
        return view('acessoNegado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $userID = auth()->user()->id;
        
        if($task->userID == $userID){
            $task->update($request->all());
            return redirect()->route('task.show',['task'=>$task->id]);           
        }
        
        return view('acessoNegado');


        


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if(!$task->userID == auth()->user()->id){
            return view('acessoNegado');
        }
        $task->delete();
        return redirect()->route('task.index');   
    }
}
