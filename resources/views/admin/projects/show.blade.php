@extends('layouts.admin')

@section('content')
    <h1>{{ $project->title }}</h1>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">{{ $project->title }}</h5>
                <p class="card-text">{{ $project->content }}</p>
                <p class="card-text">{{ $project->type ? $project->type->name : 'Nessun tipo' }}</p>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Come Back</a>
                <a href="#" class="btn btn-secondary">↑</a>
            </div>
        </div>
    </div>
@endsection
