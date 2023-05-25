@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.projects.update', ['project' => $project->slug]) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <input type="text" class="form-control" id="content" name="content"
                value="{{ old('content', $project->content) }}">
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona categoria</label>
            <select class="form-select" name="type_id" id="type_id" @error('type_id') is-invalid @enderror>
                <option selected>Open this select menu</option>
                <option @selected(old('type_id', $project->type_id) == '') value="">Nessuna categoria</option>
                @foreach ($types as $type)
                    <option @selected(old('type_id', $project->type_id) == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
@endsection
