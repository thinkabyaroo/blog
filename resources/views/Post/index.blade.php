@extends('layouts.app');
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Post List
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <p class="alert alert-success">{{session('status')}}</p>
                        @endif
                            <div class="d-flex justify-content-between">
                                {{$posts->appends(request()->all())->links()}}

                                <div class="">
                                    <form >
                                      <div class="btn-group ">
                                          <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
                                          <button class="btn btn-outline-primary" id="button-addon2">
                                              <i class="fas fa-search"></i>
                                          </button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Photo</th>
                                    <th>Category</th>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==0)
                                    <th>Owner</th>
                                    @endif
                                    <th>Control</th>
                                    <th>created_at</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox" data-gall="gallery{{$post->id}}" href="{{asset('storage/photo/'.$photo->name)}}"><img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="40" alt="image alt"/></a>
{{--                                            <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="40" alt="">--}}
                                        @empty
                                            <p class="text-muted small">no photo</p>
                                        @endforelse
                                    </td>
                                    <td>
                                        <span class="badge small bg-primary">
                                            {{$post->category->title}}
                                        </span>
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==0)
                                    <td>{{$post->user->name}}</td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-info fa-fw"></i>
                                            </a>
{{--                                            @if(\Illuminate\Support\Facades\Auth::id() == $post->user_id)--}}
{{--                                            @can('post-edit',$post)--}}

                                            @can('view',$post)
                                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                            @endcan
                                            @can('view',$post)
                                            <button form="deletePost{{$post->id}}"  class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                            @endcan
                                        </div>
                                        <form action="{{route('post.destroy',$post->id)}}" class="d-none" id="deletePost{{$post->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>


                                    </td>

                                    <td>
                                        {!! $post->show_created_at !!}
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td>There is no data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

