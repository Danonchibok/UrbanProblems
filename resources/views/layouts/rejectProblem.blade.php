<div class="card text-center">

    <p><label for="inputdesc">Опишите причину</label></p>
    <p>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="inputdesc" rows="3" value="{{old('description')}}"></textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
     </span>
     @enderror
     </p>
    <p> <input type="submit" class="btn btn-primary"> </p>
 </div>
