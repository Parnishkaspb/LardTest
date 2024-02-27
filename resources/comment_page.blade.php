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
        </div>
    </div>
@endforeach
<script>
    function comment() {
        let comment = $('#comment');
        let nameAttr = comment.attr('name');
        let parts = nameAttr.split('/');
    
        $.post({
            url: '/write_comment.php',
            data: {
                text: comment.val(),
                id_comment: parseInt(parts[0], 10),
                edit: parseInt(parts[1], 10),
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Ошибка:", status, error);
            }
        });
    }


    function updateCommentInput(id_comment, actionType) {
        $("#comment").attr("name", `${id_comment}/${actionType}`);

        var commentText = getCommentTextWithoutButtons(id_comment);

        if (actionType === 1) {
            $("#comment").val(commentText);
        }

        if (actionType === 2) {
            $('#answer_card').show();
            $("#answer_text").text(commentText);
        }
    }

    function getCommentTextWithoutButtons(id_comment) {
        return $("#" + id_comment + " .card-title").clone()
            .find('button').remove().end()
            .text().trim().replace(/^\s+/g, '');
    }

    function changeIDedit(id_comment) {
        updateCommentInput(id_comment, 1);
    }

    function answerComment(id_comment) {
        updateCommentInput(id_comment, 2);
    }
</script>

@endsection


