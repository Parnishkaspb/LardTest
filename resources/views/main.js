    function comment() {
        let comment = $('#comment');
        let nameAttr = comment.attr('name');
        let parts = nameAttr.split('/');
    
        $.post({
            url: './index.php',
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
