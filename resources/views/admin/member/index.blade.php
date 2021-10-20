@extends('layouts.app')
@section('member')
    active
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 m-auto">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModalCenter">
  Add Member
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="ajaxReqForm" action="{{url('member/post')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="">Phone number</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">      
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address">
          </div>
          <div class="form-group">
            <label for="">Profile Phote</label>
            <input type="file" name="image" class="form-control">
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
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Image</th> 
            <th>Action</th> 
          </tr>
        </thead>
        <tbody>
          @php
              $i=1;
          @endphp
          @foreach ($members as $member)                   
          <tr>
            <td>{{$i++}}</td>
            <td>{{$member->name}}</td>
            <td>{{$member->email}}</td>
            <td>{{$member->phone}}</td>
            <td>{{$member->address}}</td>
            <td>
              <img src="{{asset('public/upload/image')}}/{{$member->image}}" style="width:10%" alt="Profile Image">
            </td>
            <td>
              <a href="{{url('member/edit')}}/{{$member->id}}" class="btn btn-sm btn-info">edit</a>
              <a href="" onclick="
                var result = confirm('Are you sure permanent delete??');
                                if(result){
                event.preventDefault(); document.getElementById('delete_form-{{$member->id}}').submit(); }" class="btn btn-danger btn-sm mt-1">Delete</a>
              <form id="delete_form-{{$member->id}}" action="{{url('member/delete')}}/{{$member->id}}" method="POST">
                 @csrf
                
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

{{-- <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).ready(function(){
       
            $('#ajaxReqForm').submit(function(e){
                e.preventDefault();
               
                    jQuery.ajax({
                        url:"{{url('member/post')}}",
                        type: "post",
                        data: jQuery('#ajaxReqForm').serialize(),
                        success: function(response){
                          $('#exampleModalCenter').modal('hide'),
                           console.log(response)
                        },
                        error: function(error) {
                          $('#exampleModalCenter').modal('hide'),
                            console.log(error);
                        }
                        
                    });
                
            });
        });



    </script> --}}
@endsection