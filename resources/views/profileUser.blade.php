@extends('layouts.admin_template')
@section('content')
<div class="container rounded bg-white mt-5">
    <div class="row">
        
                    
                <h6 class="text-right">Edit Profile</h6>
                
    <form action='{{route('updateProfile',$user['Id'])}}' method="post">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <div class="row mt-2">
                <div class="col-md-6"><input type="text" name='name' placeholder="name" value="{{$user['name']}}"></div>
                    <div class="col-md-6"><input type="text" name='username' placeholder="username" value="{{$user['username']}}" ></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><input type="text" name='password' placeholder="password" value="{{$user['password']}}"></div>
                    <div class="col-md-6"><input type="text" name='status' placeholder="status" value="{{$user['status']}}" ></div>
                </div>
              
                <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </form>
    </div>
</div> 
@endsection