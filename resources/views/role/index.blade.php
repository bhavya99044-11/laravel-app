@extends('layouts.cdn')

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Add</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $row)

      <tr>
        <th scope="row">{{$row->id}}</th>
        <td>{{$row->name}}</td>
        <td><a href="{{url('roles/'.$row->id.'/add-permissions')}}" class="btn btn-primary">Add role</a></td>
        <td>Edit</td>
      </tr>
      @endforeach
    </tbody>
  </table>
