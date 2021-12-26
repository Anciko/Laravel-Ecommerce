@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
    <div class="col-md-6 offset-md-3">
        {{-- @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ Session::get('success') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        <x-flash type="success"></x-flash>

        <div class="d-flex justify-content-between my-3">
            <a href="{{ route('admin-home') }}" class="btn btn-dark btn-sm">
                << Back</a>
                    <a href="{{ route('categories.create') }}" class="btn btn-dark btn-sm"> Create + </a>
        </div>
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Child</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody class="text-center">
                @foreach ($cats as $cat)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>
                            <img src="{{ url("uploads/$cat->image") }}" alt="" width="50" height="50">
                        </td>
                        <td>
                            <a href="{{ route('categories.subcats.index', $cat->id) }}" class="btn btn-info btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="post"
                                class="d-inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
