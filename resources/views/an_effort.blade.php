@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Log an Effort Time!</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/effort_time/store') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="effort_id" value="{{ $effort->id }}">

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if ($effort_status)
                                            End Effort
                                        @else
                                            Begin Effort
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Goal</div>
                    <div class="panel-body">
                        {{ $goal->name }}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Effort</div>
                    <div class="panel-body">
                        {{ $effort->desc }}
                    </div>
                </div>

                {{-- Efforts Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Times Spent</div>
                    <div class="panel-body">
                            <table class="table table-striped user-table">

{{--
                                <thead>
                                <th>No</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                </thead>
--}}
                                <tbody>
                                @foreach ($effort_times as $effort_time)                                    
                                    <tr>
                                        <td class="table-text"><a href="{{ url('effort_time/'.$effort_time->id) }}"><div>{{ $effort_time->begin_date }}</div><a/></td>
                                        <td class="table-text"><a href="{{ url('effort_time/'.$effort_time->id) }}"><div>{{ $effort_time->end_date }}</div></a></td>
                                        <td> {{ $effort_time->duration }} </td>                                        <!-- Effort Delete Button -->
                                        <td>
                                            <form action="{{ url('effort_time/'.$effort_time->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="effort_id" value="{{ $effort->id }}">

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                                </tbody>
                            </table>

                            <a href="{{ url('/efforts/create/goal/'.$goal->id) }}">Add another effort </a>
                    </div>
                </div>
                {{-- Efforts End  --}}
            </div>
        </div>
    </div>
@endsection
