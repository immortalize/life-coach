@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a sleep!</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/sleep/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if ($sleep_status)
                                        End Sleep
                                    @else
                                        Begin Sleep
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
                    <div class="panel-heading">Current Sleeps</div>
                    <div class="panel-body">
                        @if (count($sleeps) > 0)
                            <table class="table table-striped user-table">
                                <thead>
                                <th>name</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($sleeps as $sleep)
                                    <tr>
                                        <td class="table-text"><a href="{{ url('sleep/'.$sleep->id) }}"><div>{{ $sleep->begin_date }}</div><a/></td>
                                        <td class="table-text"><a href="{{ url('sleep/'.$sleep->id) }}"><div>{{ $sleep->end_date }}</div></a></td>
                                        <td> {{ $sleep->duration }} </td>                                        
                                        <!-- user Delete Button -->
                                        <td>
                                            <form action="{{ url('sleep/'.$sleep->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete                                                    
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ url('sleep/'.$sleep->id) }}" method="GET">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Edit                                                    
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                @if ($sleep_status)
                                    <p>uykuda</p>
                                @else
                                    <p>uyanik</p>
                                @endif

                            <a href="{{ url('/sleep/create') }}">Create another sleep!</a>
                        @else
                            There is no sleeps yet. <a href="{{ url('/sleep/create') }}">Create a sleep!</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
