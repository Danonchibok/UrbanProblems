@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Привет, дорогой друг!</h1>
        <p>
            Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому мы
            предлагаем тебе помочь своему городу!
        </p>
        <p>
            Увидел проблему? Дай нам знать о ней и мы ее решим!
        </p>
        <p>
            <a class="btn btn-success btn-lg" href="{{route('feedBack')}}" role="button">Сообщить о проблеме</a>
            @if (Auth::guest())
            <a class="btn btn-primary btn-lg" href="{{route('register')}}" role="button">Присоедениться к проекту</a>
            @endif

        </p>
        <div class="row">
            <div class="col">
                <h1> Нас уже <span id="userCount" class="badge badge-light"><div id="counter">{{$countUsers}}</div></span></h1>
            </div>
            <div class="col">
                <h1> Решённых проблем <span id="problemsCount" class="badge badge-light"><div id="counter">{{$countProblems}}</div></span></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @if (count($problems))

    <h2>Последние решенные проблемы</h2>
    <br>
    <div class="card-deck">
        @foreach ($problems as $problem)


            <div class="card">
                <div class="slider">
                    <div class="slide-before">
                        <img src="{{asset('storage/'.$problem->afterPhoto)}}"  class="image-slide-before" alt="">
                    </div>
                    <div class="slide-after">
                        <img src="{{asset('storage/'.$problem->photo)}}"  class="image-slide-after" alt="">
                    </div>
                    <div class="change"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$problem->name}}</h5>
                    <p class="card-text">{{$problem->description}}
                        <p>Категория: {{$problem->categoryName}}</p>
                    </p>
                    <div class="alert alert-success" role="alert">
                        <p class="card-text">{{$problem->statusesName}}</p>
                    </div>
                </div>
                <div class="card-footer">
                    @if (isset($problem->updated_at))
                    <small class="text-muted">обновлена: {{$problem->updated_at}}</small>
                    @else
                    <small class="text-muted">Создана: {{$problem->created_at}}</small>
                    @endif
                </div>
            </div>


        @endforeach
        @else
        <div class="container">
            <h1>Пока ничего не решили</h1>
        </div>
    @endif
</div>

@endsection
@section('custom_js')
<script src="{{asset('js/slide.js')}}"></script>
<script src="{{asset('js/autoUpdate.js')}}"></script>
@endsection
