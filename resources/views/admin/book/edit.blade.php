@extends('layouts.app')
@section('book')
    active
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <form action="{{ route('book.update',$book->id)}}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label>Name</label>
                    <select name="issue_member" class="form-control" id="">
                        <option value="">Select Member</option>
                        @foreach($members as $member)
                        <option {{$member->id == $book->issue_member ? 'selected' : ''}} value="{{$member->id}}">{{$member->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" name="book_name" value="{{$book->book_name}}" class="form-control"  placeholder="Book name">
                  </div>
                  <div class="form-group">
                    <label>Book Code</label>
                    <input type="text" name="book_code" value="{{$book->book_code}}" class="form-control" placeholder="Book code">
                  </div>
                  <div class="form-group">
                    <label>Book Name</label>
                    <input type="date" name="issue_date" value="{{$book->issue_date}}" class="form-control" placeholder="Issue date">
                  </div>
                  <div class="form-group">
                    <label>Book Name</label>
                    <input type="date" name="return_date" value="{{$book->return_date}}" class="form-control" placeholder="Return Date">
                  </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>    
        </div>
    </div>
</div>
@endsection