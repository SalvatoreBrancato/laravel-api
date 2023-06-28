@extends('layouts.app')
@section('content')

<div class="row gap-2 justify-content-center">
    @forelse ($projects as $elem) 
        <div class="col-2 d-flex my-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <img src="{{asset('storage/' . $elem->path)}}" alt="">
                  <h5 class="card-title">{{$elem->title}}</h5>
                  <p class="card-text">{{$elem->description}}</p>
                <div class="btn btn-primary">{{$elem->lang}}</div>
                @if($elem->type)
                  <div>{{$elem->type->name}}</div>
                  @endif
            </div>
        </div>
</div>
    
    @empty
    @endforelse
</div>
@endsection
    