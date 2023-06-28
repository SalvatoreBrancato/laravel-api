@extends('layouts.app')
@section('content')
<h1 class="text-center">sono la pagina admin index</h1>
<div class="row gap-2 justify-content-center">
    @forelse ($posts as $elem) 
    <div class="col-2 d-flex my-2 flex-column">
        <a class="text-decoration-none d-flex" href="{{ route( 'admin.index.show', $elem->id ) }}">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <img src="{{asset('storage/' . $elem->path)}}" alt="">
                  <h5 class="card-title">{{$elem->title}}</h5>
                  <p class="card-text">{{$elem->description}}</p>
                  <div>{{$elem->lang}}</div>
                  @if($elem->type)
                  <div>{{$elem->type->name}}</div>
                  @endif
                 {{-- @if( $elem->technology )
                    
                        <div> {{ $elem->technology->name }} </div>
                    
                  @endif --}}
                </div>    
            </div>
        </a>
        
    </div>
    @empty
    @endforelse
</div>
@endsection