@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Date end</label>
                            <input type="date" class="form-control"  value="{{$task->dateEnd}}">
                        </div>                        
                    </fieldset>
                    <a href="{{url()->previous()}}" type="submit" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection