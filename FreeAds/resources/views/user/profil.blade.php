@extends('layouts.app')

@section('content')
<div class="row">

<div class="col-sm-6 offset-3">
    <h1 class="display-3">Profil</h1>    
        <div class="col-sm-12">

            @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
            @endif
          </div>
          @if(isset($user))
        @foreach($user as $profil)
        <div class="card" style="margin: 2rem">
            <div class="card-header">
                {{$profil->name}}
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{$profil->email}}</p>
                <br>
                <br>
                <footer class="blockquote-footer">Created : <cite title="Source Title">{{$profil->created_at}}@if($profil->updated_at != $profil->created_at)<p>Update at : {{$profil->updated_at}}</p>@endif</p></cite></footer>
                </blockquote>
                {{-- VERIFICATION: SI L'USER_ID CORRESPONT A L'ID DU USER --}}
                @if ($profil->id == Auth::user()->id)
                <a href="{{ route('Edit',$profil->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('Delete', $profil->id)}}" method="post">
                @csrf
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                @endif
            </div>
          </div>
        @endforeach
        @endif
  </div>
</div>
@endsection 

