
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-5">


<h3>Edit Profile</h3>
<form method="post" action="{{route('users.update', $user)}}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <div class="form-group">
        <label for="nme">name:</label>
        <input type="text"  name="name" class="form-control" id="nme">
      </div>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" name="email"  value="{{ $user->email }}" id="email">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password"  name="password" class="form-control" id="pwd">
      </div>


      <div class="form-group">
        <label for="cpwd">Confirm Password:</label>
        <input type="password"  name="password_confirmation" class="form-control" id="cpwd">
      </div>

    <button type="submit">Send</button>
</form>

</div>
</div>
</div>
</div>
@endsection

