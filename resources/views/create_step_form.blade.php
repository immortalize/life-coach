@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create an step for {{ $goal->name }}!</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/steps') }}">
                        {{ csrf_field() }}
                        <input name="goal_id" type="hidden" value="{{ $goal->id }}">

                        <div class="form-group{{ $errors->has('step_desc') ? ' has-error' : '' }}">
                            <label for="step_desc" class="col-md-4 control-label">Step Description</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="step_desc" value="{{ old('step_desc') }}" required autofocus>

                                @if ($errors->has('step_desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
