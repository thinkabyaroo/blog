@extends('layouts.app');
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Edit Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('tag.update',$tag->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" value="{{old('title',$tag->title)}}" class="form-control @error('title') is-invalid @enderror " name="title">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-outline-primary ">Edit</button>

                                </div>
                            </div>
                            @error('title')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </form>
                        @if(session('status'))
                            <p class="alert alert-success">{{session('status')}}</p>
                        @endif
                    </div>
                </div>
                @include('tag.list')

            </div>
        </div>
    </div>
@stop
