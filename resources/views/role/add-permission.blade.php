@extends('layouts.cdn')

<div class="container">
    <div class="card">
        <div class="card-header">
            Add permissions
        </div>
        <div class="card-body">
            <form action="{{url('roles/'.$role->id.'/submit-permission')}}" method="get">
            @foreach($data as $row )
                <input type="checkbox" name="permissions[]" value="{{$row->name}}">{{$row->name}}</input>
            @endforeach
            <input type="submit"></input>
            </form>
        </div>
    </div>
</div>
