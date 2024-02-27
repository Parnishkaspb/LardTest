@extends('main_page')

@section('title', $title)

@section('content')
<style>
    .button_edit{
        border: none; 
        background: white;
    }
</style>

@if ($insert)
    <div class="alert alert-success" role="alert">
        Новый комментарий успешно добавлен!
    </div>
@endif

@if ($update)
    <div class="alert alert-success" role="alert">
        Обновление комментария произошло успешно!
    </div>
@endif

@foreach($comments['main_comment'] as $id_comment => $comment)
    <div class="card mt-3">
        <div class="card-body">
            <div class="mt-2" id="{{ $id_comment }}">
                <h5 class="card-title"> {{ $comment }}
                <button class="button_edit" onclick="changeIDedit({{ $id_comment }})">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
                <button class="button_edit" onclick="answerComment({{ $id_comment }})">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </button>
                </h5>
            </div>

            @if(is_array($comments['answer_comment'][$id_comment]) && count($comments['answer_comment'][$id_comment]) > 0)
            @foreach ($comments['answer_comment'][$id_comment] as $an_comment)
                <div class="ms-3 mt-2" id="{{ $an_comment['id_comment'] }}">
                ({{ $an_comment['id_comment'] }}) -> ({{ $id_comment }}):
                    <h7 class="card-title"> {{ $an_comment['text'] }}
                        <button class="button_edit" onclick="changeIDedit({{ $an_comment['id_comment'] }})">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                        <button class="button_edit" onclick="answerComment({{ $an_comment['id_comment'] }})">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                        </button>
                    </h7>
                </div>
                @include('partials.comments', ['comments' => $comments['answer_comment'], 'id_comment' => $an_comment['id_comment']])
            @endforeach
            @endif
        </div>
    </div>
@endforeach
@endsection


