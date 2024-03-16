
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dodavanje Projekta</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end"> Naziv projekta: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description:</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" value="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">Price:</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="any" class="form-control @error('price') is-invalid @enderror" name="price" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="user_ids" class="col-md-4 col-form-label text-md-end">Select Users:</label>
                            
                            <div class="col-md-6">
                            <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="is_done" class="col-md-4 form-check-label text-md-end">Projekt završen: </label>

                            <div class="col-md-6">
                                <input id="is_done" type="checkbox" class="form-check-input @error('is_done') is-invalid @enderror" name="is_done">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Spremi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection