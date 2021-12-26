@extends('layouts.app')

@section('title', 'Edit Category')
@section('content')
    <div class="col-md-4 offset-md-4">
        <a href="{{ route('categories.index') }}" class="btn btn-dark btn-sm my-4">
            << Back</a>
                <x-flash type="error"></x-flash>
                <div class="card bg-light p-2">
                    <div class="card-body">
                        <form action="{{ route('categories.update', $cat->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" value="{{ $cat->name ?? old('name') }}">
                                @error('name')
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <p>Current Image =>
                                    <a href="{{ url("uploads/$cat->image") }}">{{ $cat->image }}</a>
                                </p>
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                    id="image">
                                @error('image')
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-outline-secondary btn-sm">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm ms-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
@endsection
