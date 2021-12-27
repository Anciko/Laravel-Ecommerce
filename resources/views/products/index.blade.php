@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="">
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
                    <a href="{{ route('products.create') }}" class="btn btn-dark btn-sm"> Create + </a>
        </div>
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Colors</th>
                    <th>Sizes</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody class="text-center">
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $product->name }}</td>

                        <td>
                            @php
                                $images = explode(',', $product->images);
                            @endphp
                            @foreach ($images as $image)
                                <img src="{{ url("/uploads/$image") }}" alt="" width="50" height="50">
                            @endforeach
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->colors }}</td>
                        <td>{{ $product->sizes }}</td>
                        <td>{{ Str::substr($product->description , 0, 10) }}...</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post"
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
