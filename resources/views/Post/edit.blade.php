@extends('layouts.app');
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.update',$post->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="col-8">
                                <div class="">
                                    <label for="">Post Title</label>
                                    <input type="text" value="{{old('title',$post->title)}}" class="form-control @error('title') is-invalid @enderror " name="title">
                                </div>
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror

                                <div class="">
                                    <label for="">Category</label>
                                    <select type="text" class="form-select @error('category') is-invalid @enderror " name="category">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{$category->id}} " {{old('category',$post->category_id)==$category->id?'selected':''}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('category')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-8">
                                <div class="">
                                    <label for="">Description</label>
                                    <textarea type="text" rows="10" class="form-control @error('description') is-invalid @enderror " name="description">{{old('description',$post->description)}}</textarea>
                                </div>
                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <button class="btn btn-outline-primary">update post</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Mange Photo</div>
                    <div class="card-body">
                        <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data" id="uploaderForm" class="d-none">
                            @csrf
                            <input type="hidden" value="{{$post->id}}" name="post_id">
                            <input type="file" class="form-control" accept="image/jpeg,image/png" id="uploaderInput" name="photo[]" multiple >
                            <button class="btn btn-outline-primary">Upload</button>
                        </form>
                        <div class="mb-3 ">
                            <div class="d-inline-flex justify-content-center align-items-center border border-dark border-3 px-3 rounded" id="uploaderUi">
                                <i class="fas fa-plus-circle fa-2x"></i>
                            </div>
                            @forelse($post->photo as $photo)

                                <div class="d-inline-block position-relative" style="width: 100px; height: 100px;">
                                    <img src="{{asset('storage/thumbnail/'.$photo->name)}}" class="position-absolute" height="100" alt="">
                                    <form action="{{route('photo.destroy',$photo->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-sm position-absolute" style="bottom: 5px;right: 5px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                            @endforelse
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
        let uploaderUi =document.getElementById('uploaderUi');
        let uploaderInput =document.getElementById('uploaderInput');
        let uploaderForm =document.getElementById('uploaderForm');
        uploaderUi.addEventListener('click',function (){
            uploaderInput.click();
        })
        uploaderInput.addEventListener('change',function (){
            uploaderForm.submit();
        })


    </script>
@stop
