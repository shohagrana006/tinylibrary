@extends('layouts.app')
@section('book')
    active
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 m-auto">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModalCenter">
  Issue Book
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Issue Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('book.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label>Name</label>
            <select name="issue_member" class="form-control" id="">
                <option value="">Select Member</option>
                @foreach($members as $member)
                <option value="{{$member->id}}">{{$member->name}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Book Name</label>
            <input type="text" name="book_name" class="form-control"placeholder="Book name">
          </div>
          <div class="form-group">
            <label>Book Code</label>
            <input type="text" name="book_code" class="form-control"placeholder="Book code">
          </div>
          <div class="form-group">
            <label>Book Name</label>
            <input type="date" name="issue_date" class="form-control"placeholder="Issue date">
          </div>
          <div class="form-group">
            <label>Book Name</label>
            <input type="date" name="return_date" class="form-control"placeholder="Return Date">
          </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-10 m-auto">
      @if ($errors->any())
          <div class="alert alert-danger">
           @foreach ($errors->all() as $error)
             <li class="nav-item">{{$error}}</li>  
           @endforeach
          </div>
      @endif
      @if (session('success'))
          <div class="alert alert-success">
            {{session('success')}}
          </div>
      @endif
      @if (session('delete'))
          <div class="alert alert-danger">
            {{session('delete')}}
          </div>
      @endif
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Issue Member</th>
            <th>Book Name</th>
            <th>Book Code</th>
            <th>Issue Date</th>
            <th>Return date</th> 
            <th>Action</th> 
          </tr>
        </thead>
        <tbody>
          @php
              $i=1;
          @endphp
          @foreach ($books as $book)                   
          <tr>
            <td>{{$i++}}</td>
            <td>{{$book->bookToMember->name}}</td>
            <td>{{$book->book_name}}</td>
            <td>{{$book->book_code}}</td>
            <td>{{$book->issue_date}}</td>
            <td>{{$book->return_date}}</td>
            {{-- <td>{{$book->return_status}}</td> --}}
            <td>
                @if ($book->return_status == 1)    
                    <a href="{{route('pending', $book->id)}}" class="btn btn-sm btn-warning">Pending</a>
                @else
                    <a href="{{route('returned', $book->id)}}" class="btn btn-sm btn-success">Returned</a>
                @endif
              <a href="{{route('book.edit',$book->id)}}" class="btn btn-sm btn-info">edit</a>
              <a href="" onclick="
                var result = confirm('Are you sure permanent delete??');
                                if(result){
                event.preventDefault(); document.getElementById('delete_form-{{$book->id}}').submit(); }" class="btn btn-danger btn-sm mt-1">Delete</a>
              <form id="delete_form-{{$book->id}}" action="{{route('book.destroy',$book->id)}}" method="POST">
                 @csrf
                 @method('DELETE')
                
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>



@endsection

@section('footer_script')

@endsection