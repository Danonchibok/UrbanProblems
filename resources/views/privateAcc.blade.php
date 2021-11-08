@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>{{Auth::user()->name}}</h1>
        <h4>Личный кабинет</h4>
    </div>

</div>
<div class="container">
    <div class="works">
        @if (count($problems))

        <h2 >Ваши заявки </h2>
        <div class="container-form">
            <form id="form">
                @csrf
                <div class="row">

                    <div class="col">
                        <input type="text" placeholder="Поиск" id="prbName" name="prbName" class="form-control">
                    </div>
                    <div class="col">
                        <input type="submit" value="Найти" class="btn btn-primary btnCol">

                    </div>
                </div>
            </form>

        </div>
<br>
        <div class="card-deck" id="prb">

            @foreach ($problems as $problem)


                <div class="card">
                    <img src="{{asset('storage/'.$problem->photo)}}"  class="img-thumbnail" alt="{{$problem->description}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$problem->name}}</h5>
                        <p class="card-text">{{$problem->description}}
                           <p>Категория: {{$problem->categoryName}}</p>
                        </p>

                        @if ($problem->statusId == 2)
                            <div class="alert alert-success" role="alert">
                                <p class="card-text">{{$problem->statusesName}}</p>
                            </div>
                        @else
                        <div class="alert alert-danger" role="alert">
                            <p class="card-text">{{$problem->statusesName}}</p>
                        </div>

                        <Form id="del-form">
                            @csrf
                            <input type="text" name="id" id="" style="display: none" value="{{$problem->id}}">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
                                удалить
                            </button>
                            <!--
                            <input class="btn btn-primary" type="submit" value="Удалить">
                            -->
                        </Form>

                        @endif

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
        </div>
        @else
        <h1>Вы ещё не оставляли заявок</h1>
        <a class="btn btn-success btn-lg" href="{{route('feedBack')}}" role="button">Оставить заявку</a>
        @endif

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Удаление заявки</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Действие необратимо. Вы уверены, что хотите удалить эту заявку?
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirm-delete">Удалить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('custom_js')
<script>
/*
        let formElem = document.querySelector('#form');
        let delForm = document.querySelectorAll('#del-form');
        let backForm = document.querySelector('#form-back');
        let divrow = document.querySelector('.row');
        let searchBtn = document.querySelector('.btnCol');
        console.log(delForm);


        function GetProblems(fetchPath, form) {
            form.addEventListener('submit', async(e)=>{
                console.log('as');
                e.preventDefault();
                let response = await fetch(fetchPath , {
                    method: 'POST',
                    body: new FormData(form)

                });
                let result = await response.text();

                document.querySelector('.works').innerHTML = result;
            });
        }


        GetProblems("{{route('insertSearch')}}", formElem);
        GetProblems("{{route('backSearch')}}", backForm);


        document.addEventListener('click', ()=>{


            document.onsubmit = async(e) => {
                const target = e.target.closest('#del-form');
                e.preventDefault();
                if(target){
                    let response = await fetch("{{route('deleteProblem')}}" , {
                        method: 'POST',
                        body: new FormData(target)

                    });
                    let result = await response.text();
                    document.querySelector('.works').innerHTML = result;
                }

            };
        });
        /*
        formElem.onsubmit = async(e) => {

        };
*/






</script>
@endsection
