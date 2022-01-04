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
                        <form action="{{route('post.update',$post->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="col-4">
                                <div class="">
                                    <label for="">Post Title</label>
                                    <input type="text" value="{{old('title',$post->title)}}" class="form-control @error('title') is-invalid @enderror " name="title">
                                </div>
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-4">
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
                            </div>


                            <div class="col-4">
                                <div class="">
                                    <label for="">Description</label>
                                    <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror " name="description">{{old('description',$post->description)}}</textarea>
                                </div>
                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="">
                                <button class="btn btn-outline-primary">Edit</button>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
@stop
