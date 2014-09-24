@extends('layouts.default')
<div class="container">
    <div>
        @if(Auth::check())
            <p>Welcome to your profile page {{Auth::user()->first_name}} - {{Auth::user()->last_name}}</p>
            <br>
            <div class="col-md-6 col-md-offset-0">
                <table class="table table-hover">
                    <tr class="info"><td>First Name: {{Auth::user()->first_name }}</td></tr>
                    <tr class="active"><td>Last name: {{Auth::user()->last_name}}</td></tr>
                    <tr class="info"><td>Email Address : {{Auth::user()->email}}</td></tr>
                </table>
            </div>
            
            <div class="col-md-2 col-md-offset-4">
                <div class="form-group">
                    @if(Auth::user()->image)
                    <img width="170px" height="130px" src='{{Auth::user()->image}}'>
                </div>
            </div>
            
            @else
                {{Form::open(array('route' => array('uploadimage'), 'method' => 'post', 'files'=>true)) }}
                
                <div class="col-md-0 col-md-offset-3">
                    <div class="form-group">
                        <img width="170px" height="130px" src="">
                        {{ Form::label('file','ProfilePicture')}}
                        {{ Form::file('upload_image','',array('class'=>'form-control')) }}
                    </div>
                    {{Form::submit('Upload', array('class' => 'btn btn-primary'))}}
                    {{Form::close() }}

                    @foreach ($errors->all() as $message)
                    *{{$message}}
                    @endforeach
                </div>
                
            @endif
        @endif
    </div>
</div>