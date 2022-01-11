<table class="table table-bordered align-middle table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created_at</th>
    </tr>
    </thead>
    <tbody>
    @forelse($tags as $tag)
        <tr>
            <td>{{$tag->id}}</td>
            <td>{{$tag->title}}</td>
            <td> {{\Illuminate\Support\Facades\Auth::id()}}</td>
            <td>
                <a href="{{route('tag.edit',$tag->id)}}" class="btn btn-outline-warning">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                </a>
                <form action="{{route('tag.destroy',$tag->id)}}" class="d-inline-block" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-danger">
                        <i class="fas fa-trash fa-fw"></i>
                    </button>
                </form>
            </td>

            <td>
                <p class="small mb-0">
                    <i class="fas fa-calendar"></i>
                    {{$tag->created_at->format('d m Y')}}
                </p>
                <p class="small mb-0">
                    <i class="fas fa-clock"></i>
                    {{$tag->created_at->format('h i a')}}
                </p>
                {{$tag->created_at->diffForHumans()}}
        </tr>

    @empty
        <tr>
            <td colspan="5">There is no data</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{$tags->links()}}
