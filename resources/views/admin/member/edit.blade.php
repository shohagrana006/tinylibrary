@extends('layouts.app')
@section('member')
    active
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <form action="{{url('member/update')}}/{{$member->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" value="{{$member->name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" value="{{$member->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="">Phone number</label>
                  <input type="text" name="phone" class="form-control" value="{{$member->phone}}" placeholder="Enter Phone">      
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" name="address" class="form-control" value="{{$member->address}}" placeholder="Enter address">
                </div>
                <div class="form-group">
                  <label for="">Profile Phote</label>
                  <input type="file" name="image" class="form-control">
                </div>
                   
                <button type="submit" class="btn btn-primary">Update</button>
            </form>         
        </div>
    </div>
</div>
@endsection