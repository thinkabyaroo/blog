@extends('layouts.app');
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Manage Post
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                                <div class="">
                                    <label for="">Post Title</label>
                                    <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror " name="title">
                                </div>
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror

                                <div class="">
                                    <label for="">Category</label>
                                    <select type="text" class="form-select @error('category') is-invalid @enderror " name="category">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{$category->id}} " {{old("category")==$category->id?'selected':''}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('category')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror

                            <div class="">
                                <label for="">Photo</label>
                                <input type="file" name="photo[]" value="{{old('title')}}" class="form-control @error('photo') is-invalid @enderror" multiple>
                                @error('photo')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <div class="">
                                    <label for="">Description</label>
                                    <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror " name="description">{{old('description')}}</textarea>
                                </div>
                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="">
                                <button class="btn btn-outline-primary">Add</button>
                            </div>

                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
@stop
