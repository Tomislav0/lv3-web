@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            @if ($foreign_projects->isEmpty() && $my_projects->isEmpty())
            Nema niti jedan projekt
            @endif
            @if (!$my_projects->isEmpty())
            <h2 class="text-center">Moji projekti </h2>
            @foreach ($my_projects as $project)
                <div class="col-md-4" onclick="redirectToEdit({{ $project->id }})">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text">Cijena: {{ $project->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
            @if (!$foreign_projects->isEmpty())
                <h2 class="text-center">Projekti u kojima sudjelujem </h2>
                @foreach ($foreign_projects as $project)
                    <div class="col-md-4" onclick="redirectToEdit({{ $project->id }})">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->name }}</h5>
                                <p class="card-text">{{ $project->description }}</p>
                                <p class="card-text">Cijena: {{ $project->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
</div>
@endsection

<script>
    function redirectToEdit(projectId) {
        window.location.href = "/project/" + projectId ;
    }
</script>