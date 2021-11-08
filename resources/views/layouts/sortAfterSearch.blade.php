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
    <div class="container">

        @if (isset($message))
        <div class="alert alert-success" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
    </div>

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
                            <input class="btn btn-primary" type="submit" value="Удалить">
                        </Form>

                        @endif

                </div>
                <div class="card-footer">
                    @if (isset($problem->updated_at))
                    <small class="text-muted">Последнее обновление: {{$problem->updated_at}}</small>
                    @else
                    <small class="text-muted">Создана: {{$problem->created_at}}</small>
                    @endif
                </div>
            </div>


        @endforeach
    </div>
    <br>
    <div class="container-form">
        <form id="form-back">
            @csrf
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <input type="submit" value="Назад" class="btn btn-primary">
        </form>

    </div>
    @else
    <h2 >Ваши заявки </h2>
    <div class="container-form">
        <form id="form">
            @csrf
            <div class="row">

                <div class="col">
                    <input type="text" placeholder="Поиск" id="prbName" name="prbName" class="form-control">
                </div>
                <div class="col">
                    <input type="submit" value="Найти" class="btn btn-primary">

                </div>
            </div>
        </form>

    </div>
<br>

        <h1>Заявок не найдено</h1>
        <div class="container-form">
            <form id="form-back">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <input type="submit" value="Назад" class="btn btn-primary">
            </form>

        </div>
    <br>
    </div>
    @endif
