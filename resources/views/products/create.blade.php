@extends('layouts.app')
@section('title', 'Create Product')
@section('content')
    <div class="col-md-8 offset-md-2">
        <a href=" {{ route('products.index') }} " class="btn btn-dark btn-sm my-4">
            << Back </a>
            @if ($errors->any())
                @foreach ($errors->all() as $error )
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif
                <div class="card p-2 bg-light">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                            name="name">
                                        @error('name')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                            name="category_id" onchange="catChange(event)">
                                            @foreach ($cats as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="form-text text-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subcat_id" class="form-label">Sub Category</label>
                                        <select class="form-select @error('subcat_id') is-invalid @enderror"
                                            id="subcat_id" name="subcat_id">
                                            @foreach ($subcats as $subcat)
                                                <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcat_id')
                                            <div class="form-text text-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tag_id" class="form-label">Tag</label>
                                        <select class="form-select @error('tag_id') is-invalid @enderror" id="tag_id" name="tag_id">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tag_id')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            id="price" name="price">
                                        @error('price')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="colors" class="form-label">Colors (Insert Comma',' between color
                                            names! ) </label>
                                        <input type="text" class="form-control @error('colors') is-invalid @enderror"
                                            id="colors" name="colors">
                                        @error('colors')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sizes" class="form-label">Sizes (Insert Comma',' between sizes! )
                                        </label>
                                        <input type="text" class="form-control @error('sizes') is-invalid @enderror"
                                            id="sizes" name="sizes">
                                        @error('sizes')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Images </label>
                                        <input type="file" class="form-control @error('images') is-invalid @enderror"
                                            id="images" name="images[]" multiple>
                                        @error('images')
                                            <div class="form-text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"
                                        rows="3"></textarea>
                                    @error('desc')
                                        <div class="form-text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-outline-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary ms-2">Create</button>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>

    </div>
@endsection

@push('script')
    <script>
        let cats = "{{ $cats }}";
        cats = cats.replace(/&quot;/g, "\"");
        cats = JSON.parse(cats);

        let subcats = " {{ $subcats }} ";
        subcats = subcats.replace(/&quot;/g, "\"");
        subcats = JSON.parse(subcats);

        const catChange = function(e) {
            let catId = e.target.value;
            filterSub(catId);
        }

        const filterSub = function(id) {
            let subs = subcats.filter(s => s.category_id == id);
            let str = "";
            subs.forEach(sub => str += `<option value="${sub.id}">${sub.name}</option>`);
            document.querySelector("#subcat_id").innerHTML = str;
        }

        filterSub(cats[0].id);
    </script>
@endpush
