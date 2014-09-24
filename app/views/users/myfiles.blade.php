@extends('layouts.default')
<div class="container">
    <div>
        <p class="text-success">Welcome to your Gallery {{Auth::user()->first_name}}-{{Auth::user()->last_name}}...</p><br>
    </div>
    <div class="row">
        @foreach($files as $file)
        <div class="col-md-3 col-md-offset-0">
            <a href="#" class="thumbnail">
            <img src="{{ $file->thumbnail_path }}" alt="...">
            </a>
        </div>
    @endforeach
    
    <div class="container">
        {{Form::open(array('route' => array('uploadfile'), 'method' => 'post', 'files'=>true)) }}
        <div class="col-md-3">
            <div class="thumbnail" width="200" height="200">
            <div class="form-group">
                {{ Form::label('file','Upload new file')}}
                {{ Form::file('uploadfile','',array('class'=>'form-control')) }}
            </div>
            {{Form::submit('Upload', array('class' => 'btn btn-primary'))}}
            {{Form::reset('Reset', array('class' => 'btn btn-primary')) }}
            {{Form::close() }}
            </div>

            @foreach ($errors->all() as $message)
            <br>*{{$message}}
            @endforeach
        </div>
    </div>
    </div>
</div>