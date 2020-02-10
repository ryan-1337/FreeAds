@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                            {{-- VERIFICATION: SI L'USER_ID CORRESPONT A L'ID DU USER --}}
                @if ($ad->user_id == Auth::user()->id)

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Ad') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('Edit_Ad_Post', $ad->id) }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('tags') is-invalid @enderror" name="title" value="{{ $ad->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                            <textarea id="description" type="text-area" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{$ad->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6 input-group-prepend">
                                <span class="input-group-addon-text">$</span>
                                <input id="price" type="number" class="form-control currency @error('price') is-invalid @enderror" name="price" value="{{ $ad->price }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                            <div class="col-md-6">
                                <input id="pictures" type="file"  name="pictures[]" multiple class="form-control-file @error('picture') is-invalid @enderror"  value="{{ old('pictures') }}" autocomplete="pictures">

                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin: 2rem;">
                                    {{('Submit')}}
                                </button>
                            </div>
                        </div>
                    </form>

                            <div class="row">
                        @foreach ($picture as $picture)
                        <div class="col-md-3">
                            <img src="{{ asset('uploads/ad/' . $picture->name) }}" style="width: 50%; margin: 1rem;" class="rounded mx-auto d-block" alt="..."> 
                            <form method="POST" action="{{ route('Delete_Picture', $picture->id)}}">
                                    @csrf
                            <input type="submit" class="btn btn-danger" value="Delete Picture">
                            </form>
                        </div>
                        @endforeach
                            </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('message')  }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@else 
<div class="alert alert-warning" role="alert">
        <p>Vous N'avez pas accès a cette page !</p>
      </div>
@endif
@endsection