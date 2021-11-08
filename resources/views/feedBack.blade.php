@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Оставить заявку</h1>
        <h4>Личный кабинет</h4>
    </div>

</div>
<div class="mes">
    @if (isset($message))
    <div class="container">
        <div class="alert alert-success" role="alert">
               {{$message}}
             </div>
       </div>
    @endif
</div>
<div class="container">
    <form class="row g-3" id="FeedbackForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="inputName" class="form-label">Название</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{old('name')}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">

            <label for="inputCategory" class="form-label">Выбери категорию</label>
            <select name="category" id="inputCategory" class="custom-select @error('category') is-invalid @enderror" value="{{old('category')}}">
                <option value="" selected disabled>Категория</option>
                @foreach ($categories as $category)
                    <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                @endforeach
            </select>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12">
            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="exampleFormControlTextarea1" rows="3" value="{{old('description')}}"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12">
            <label for="inputImage">Загрузите фото</label>
            <input type="file" id="inputImage" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{old('photo')}}">
            @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <input type="text" value="1" name="statusId" style="display: none">
        <div class="col-12">
                <br>
            <input type="submit" class="btn btn-primary">
          </div>
    </form>

</div>
@endsection
