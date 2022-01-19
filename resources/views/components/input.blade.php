<label for="">{{$inputLabel}}</label>
<input type="text"

       @if($value)
       value="{{old($title,$value)}}"

       @else
       value="{{old($title)}}"
       @endif
       class="form-control
    @error($title) is-invalid @enderror "
       name=$title>
