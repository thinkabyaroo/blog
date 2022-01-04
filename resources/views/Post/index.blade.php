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
                                {{$posts->links()}}

                                <div class="">
                                    <form >
                                        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>created_at</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{Str::words($post->title,10)}}</td>
                                    <td>
                                        <span class="badge small bg-primary">
                                            {{$post->category->title}}
                                        </span>
                                    </td>
                                    <td>{{$post->user->name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-info fa-fw"></i>
                                            </a>
                                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                            <button form="deletePost{{$post->id}}"  class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </div>
                                        <form action="{{route('post.destroy',$post->id)}}" class="d-none" id="deletePost{{$post->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>


                                    </td>
                                    <td> <p class="small mb-0">
                                            <i class="fas fa-calendar"></i>
                                            {{$post->created_at->format('d m Y')}}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="fas fa-clock"></i>
                                            {{$post->created_at->format('h i a')}}
                                        </p>
                                        {{$post->created_at->diffForHumans()}}</td>
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

