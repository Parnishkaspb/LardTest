@if(is_array($comments[$id_comment]) && count($comments[$id_comment]) > 0)
    @foreach ($comments[$id_comment] as $re_answer)
        <div class="ms-5 mt-2" id="{{ $re_answer['id_comment'] }}">
        ({{ $re_answer['id_comment'] }}) -> ({{ $id_comment }}): 
            <h7 class="card-title">{{ $re_answer['text'] }}
                <button class="button_edit" onclick="changeIDedit({{ $re_answer['id_comment'] }})">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
                <button class="button_edit" onclick="answerComment({{ $re_answer['id_comment'] }})">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </button>
            </h7>
        </div>                    
        @include('partials.comments', ['comments' => $comments, 'id_comment' => $re_answer['id_comment']])              
    @endforeach
@endif

