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

                                <div class="mb-3">
                                    <x-input title="title" inputLabel="Post title"></x-input>
{{--                                    <label for="">Post Title</label>--}}
{{--                                    <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror " name="title">--}}
                                </div>
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror

                                <div class="mb-3">
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

                            <div class="mb-3">
                                <label for="" class="form-label">Post Tags</label>
                                <br>
                                @foreach(\App\Models\Tag::all() as $tag)
                                    <input class="form-check-input" type="checkbox" {{in_array($tag->id,old('tags',[]))?'checked':''}} name="tags[]" value="{{$tag->id}}" id="tag{{$tag->id}}">
                                    <label class="form-check-label" for="tag{{$tag->id}}">
                                        {{$tag->title}}
                                    </label>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label for="">Photo</label>
                                <input type="file" name="photos[]" value="{{old('photos')}}" class="form-control @error('photo') is-invalid @enderror" multiple>
                                @error('photos')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror " name="description">{{old('description')}}</textarea>
                                </div>
                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
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
