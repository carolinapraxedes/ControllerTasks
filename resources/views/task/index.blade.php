@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task <a href="{{route('task.create')}}" class="float-right">New task</a></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Task</th>
                                <th scope="col">Date end</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $taskLista)
                            <tr>
                                <th scope="row">{{$taskLista['id']}}</th>
                                <td>{{$taskLista['task']}}</td>
                                <td>{{date('d/m/Y', strtotime($taskLista['dateEnd']))}}</td>
                                <td><a href="{{route('task.edit',$taskLista['id'])}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a></td>
                                <td>
                                    <form id="form_{{$taskLista['id']}}" method="post" action="{{route('task.destroy',['task'=>$taskLista['id']])}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a href="#" onclick="document.getElementById('form_{{$taskLista['id']}}').submit()">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item "><a class="page-link" href="{{$task->previousPageUrl()}}">Previous</a></li>
                            @for($i = 1; $i <= $task->lastPage(); $i++)
                                <li class="page-item {{$task->currentPage()  == $i ? 'active' : ''}}">
                                    <a class="page-link" href="{{$task->url($i)}}">{{$i}}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{$task->nextPageUrl()}}">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection