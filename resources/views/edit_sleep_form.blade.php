@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update the sleep</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/sleep/update') }}">
                        {{ csrf_field() }}
                        <input name="id" type="hidden" value="{{ $sleep->id }}">                        
                        <!-- -->
                        <div class="form-group{{ $errors->has('begin_date') ? ' has-error' : '' }}">
                            <label for="begin_date" class="col-md-4 control-label">Begin Time</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="begin_date" value="{{ $sleep->begin_date or old('begin_date') }}" required autofocus>
                                @if ($errors->has('begin_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('begin_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- -->
                        <!-- -->
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">End Time</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="end_date" value="{{ $sleep->end_date or old('end_date') }}" required autofocus>

                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- -->                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
