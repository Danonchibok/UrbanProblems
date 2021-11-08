@if (isset($message))
<div class="alert alert-success" role="alert">
    <p>{{$message}}</p>
</div>
@endif
<form action="" id="addCat">
    @csrf
    <div class="col-md-12">
        <label for="inputName" class="form-label">Название</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{old('name')}}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-12">
        <br>
    <input type="submit" class="btn btn-primary" value="Добавить">
  </div>
</form>
<br>
