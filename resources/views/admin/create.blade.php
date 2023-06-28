@extends( 'layouts.app' );

@section('content')
<div class="container">
    <h1>Form create nuovo progetto</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li> {{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route( 'admin.index.store' ) }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="projects-title" class="form-label">Title</label>
            <input type="text" id="projects-title" name="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="projects-description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="projects-description" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="projects-lang" class="form-label">Lang</label>
            <input type="text" id="projects-lang" name="lang" class="form-control">
        </div>

        <div class="form-group">
            <label for="type" class="form-label">Types</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type">
                <option value="">- - Scegli Un Type - - </option>
                @foreach ($types as $elem)
                    <option value="{{$elem->id}}">{{$elem->name}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="path" class="form-label">Immagine</label>
            <input type="file" id="path" name="path"  class="form-control">
        </div>

        <div class="form-group mt-3">
            @foreach($technology as $elem)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$elem->id}}" id="checkbox{{$elem->id}}" name="technology[]">
                <label class="form-check-label" for="checkbox{{$elem->id}}">
                     {{$elem->name}}
                </label>
              </div>
            @endforeach
        </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2">Inserisci nuovo progetto</button>

    </form>
</div>
@endsection