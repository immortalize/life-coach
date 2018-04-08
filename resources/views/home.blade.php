@extends('layouts.app')
<script type="text/javascript">   
    function Redirect() 
    {  
        window.location="/goals"; 
    } 
    setTimeout('Redirect()', 500);
</script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
