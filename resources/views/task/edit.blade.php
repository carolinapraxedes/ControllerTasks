@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    <form method="post" action="{{route('task.update',['task'=>$task->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Task</label>
                            <input type="text" class="form-control" name="task" value="{{$task->task}}">
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date end</label>
                            <input type="date" class="form-control" name="dateEnd" value="{{$task->dateEnd}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection