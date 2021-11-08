@extends('layouts.app')
@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Административная панель</h1>
        <button type="button" class="btn btn-primary btn-sm" onclick="getView('{{route('getUsers')}}')">Пользователи</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="getView('{{route('getProblems')}}')">Последнии зявки</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="getView('{{route('getCategories')}}')">Категории</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="getinputs('{{route('addCategoryInput')}}', '.addCategory')">Добавить категорию</button>

    </div>
</div>


<div class="container">
    <div class="addCategory">




@if (isset($users))


    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">login</th>
                <th scope="col">Email</th>
                <th scope="col">Зарегестрирован</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

@endif

@if (isset($problems))

    <div class="row">

        @foreach ($problems as $problem)

        <div class="col-sm-4">
            <div class="card">
            <img src="{{asset('storage/'.$problem->photo)}}"  class="img-thumbnail" alt="{{$problem->description}}">
                <div class="card-body">
                    <h5 class="card-title">{{$problem->name}}</h5>
                    <p class="card-text">{{$problem->description}}</p>
                    @if ($problem->statusId == 2)
                    <div class="alert alert-success" role="alert">
                        <p class="card-text">{{$problem->statusesName}}</p>
                    </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                        <p class="card-text">{{$problem->statusesName}}</p>
                    </div>
                    <div class="row">

                        <div class="col">
                            <button class="btn btn-primary btn-sm" id="solveProblem">Решить</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-sm" id="rejectProblem">Отклонить</button>
                        </div>

                    </div>
                    <form action="" id="sub">
                        @csrf
                        <input type="text" name="id" id="" style="display: none" value="{{$problem->id}}">
                        <div class="inResponse">

                        </div>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
    </div>

@endif
@if (isset($categories))

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Удаление</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>

                <td>{{$category->categoryId}}</td>
                <td>{{$category->categoryName}}</td>
                <td>
                    <div class="mes">

                        <form action="" id="del-Category">
                            @csrf
                            <input type="hidden" name="categoryId" id="" value="{{$category->categoryId}}">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
                                удалить
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

@endif
</div>
</div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Удаление категории</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Действие необратимо. Вы уверены, что хотите удалить эту категорию, все связаные с ней заявки так же будут удалены?
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirm-delete">Удалить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        </div>
      </div>
    </div>
  </div>

@endsection
