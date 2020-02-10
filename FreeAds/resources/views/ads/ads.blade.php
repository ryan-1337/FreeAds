@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">

<div class="col-sm-10 offset-1">
    <h1 class="display-3 text-center" style="padding-bottom: 3rem;">Ads</h1>    
        <div class="col-sm-12">

            @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
            @endif
          </div>
        @foreach($ads as $ad)
                <div class="card flex-row flex-wrap" style="margin: 2rem;">
                    {{-- {{dd($ad->picture[0]->name)}} --}}
                    @if(isset($ad->picture[0]->name))
                <img class="card-img-left rounded" style="width: 300px;" src="{{ asset('uploads/ad/' . $ad->picture[0]->name) }}" alt="Card image cap">
                @endif
                  <div class="card-body">
                  <a href="{{ route('Show_Ad', $ad->id) }}" style="color:black"><h5 class="card-title"><strong>{{ $ad->title }}</strong></h5></a>
                  <p class="card-text">{{ $ad->description }}</p>
                  <p class="card-text" style="color:coral">{{ $ad->price }} €</p>
                  <p class="card-text"><small class="text-muted">Add : {{ $ad->created_at }}</small></p>
                  </div>
                {{-- VERIFICATION: SI L'USER_ID CORRESPONT A L'ID DU USER --}}
                {{-- @if ($ad->user_id == Auth::user()->id) --}}
                {{-- <a href="{{ route('Edit',$ad->id)}}" class="btn btn-primary">Edit</a> --}}
                </div>
                {{-- @endif --}}
        @endforeach
        {{ $ads->links() }}
</div>
</div>
</div>

@endsection