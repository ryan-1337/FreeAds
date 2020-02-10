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

          <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                </ol>
          <div class="carousel-inner">
                @foreach($picture as $key => $picture)
                {{-- {{dd($picture->ad_id)}} --}}
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}" style="height: 500px">
                        <img class="d-block w-100" style="max-height: 500px;" src="{{ asset('uploads/ad/' . $picture->name)}}" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>{{$ad->title}}</h5> --}}
                            {{-- <p>{{$ad->description}}</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> 
        @foreach($ad as $ad)
                <div class="card">
                  <div class="card-body">
                  <a href="{{ route('Show_Ad', $ad->id) }}" style="color:black"><h5 class="card-title"><strong>{{ $ad->title }}</strong></h5></a>
                  <p class="card-text">{{ $ad->description }}</p>
                  <p class="card-text" style="color:coral">{{ $ad->price }} €</p>
                  <p class="card-text"><small class="text-muted">Add : {{ $ad->created_at }}</small></p>
                  </div>
                {{-- VERIFICATION: SI L'USER_ID CORRESPONT A L'ID DU USER --}}
                @if ($ad->user_id == Auth::user()->id)
                <div class="row">
                <div class="col-sm-6">
                <a href="{{ route('Edit_Ad',$ad->id)}}" class="btn btn-primary" style="margin: 1rem;">Edit</a>
                <form method="POST" action="{{route('Delete_Ad', $ad->id)}}">
                    @csrf
                <input type="submit" class="btn btn-danger" value="Delete Ad">
                </form>
                </div>
                </div>
                </div>
                @endif
            @endforeach 
</div>
</div>
</div>

@endsection