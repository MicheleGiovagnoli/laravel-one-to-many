@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf

        {{-- TITOLO --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        {{-- CONTENUTO --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <input @error('content') is-invalid @enderror type="text" class="form-control" id="content" name="content">
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- SELEZIONA CATEGORIA --}}
        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona categoria</label>

            <select class="form-select" name="type_id" id="type_id" @error('type_id') is-invalid @enderror>
                <option selected>Open this select menu</option>

                <option @selected(old('type_id') == '') value="">Nessuna categoria</option>

                @foreach ($types as $type)
                    <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
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
