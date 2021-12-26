@extends('layouts.app')

@section('title', 'All Tags')

@section('content')
    <div class="col-md-6 offset-md-3">
        <x-flash type="success"></x-flash>

        <div class="d-flex justify-content-between my-3">
            <a href="{{ route('admin-home') }}" class="btn btn-dark btn-sm">
                << Back</a>
                    <a href="{{ route('tags.create') }}" class="btn btn-dark btn-sm"> Create + </a>
        </div>
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody class="text-center">
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <img src="{{ url("uploads/$tag->image") }}" alt="" width="50" height="50">
                        </td>

                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="post"
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
