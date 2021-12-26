@extends('layouts.app')

@section('title', 'All Sub Categories')

@section('content')
    <div class="col-md-6 offset-md-3">
        {{-- Show success Flash message Here --}}

        <x-flash type="success"></x-flash>
        <div class="d-flex justify-content-between my-3">
            <a href="{{ route('categories.index') }}" class="btn btn-dark btn-sm">
                << Back</a>
                    <a href=" {{ route('categories.subcats.create', $cat->id) }} " class="btn btn-dark btn-sm"> Create +
                    </a>
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
                @foreach ($cat->subcats as $subcat)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $subcat->name }}</td>
                        <td>
                            <img src="{{ url("uploads/$subcat->image") }}" alt="" width="50" height="50">
                        </td>
                        <td>
                            <a href="{{ route('subcats.edit', $subcat->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('subcats.destroy', $subcat->id) }}" method="post"
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
