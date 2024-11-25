@extends('layouts.cdn')

<div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create permission</h4>
                </div>
                <div class="card-body">
                    <form action="{{url('permissions')}}" method="post">
                        @csrf
                    <input type="text" name="name"></input>
                    <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
