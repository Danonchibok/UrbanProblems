   <div class="card text-center">

       <p><label for="inputImage">Загрузите фото</label></p>
       <p>
       <input type="file" id="inputImage" class="form-control @error('afterPhoto') is-invalid @enderror" name="afterPhoto" value="{{old('photo')}}">
       @error('afterPhoto')
       <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
        </span>
        @enderror
        </p>
       <p> <input type="submit" class="btn btn-primary"> </p>
    </div>

