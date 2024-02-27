<?php
use Project\DB\DB;
use Jenssegers\Blade\Blade;

require_once __DIR__ . '/vendor/autoload.php';


class workWithComment extends DB {
    public function __construct() {
        parent::__construct();
    }
    protected function selectAllComments(){
        $data = $this->fetchAll('SELECT id_comment, answer_id_comment, text FROM comments');

        $comments = [
            'main_comment' => [],
            'answer_comment' => []
        ];
        foreach ($data as $row){  
            if ((int)$row['answer_id_comment'] === 0){
                $comments['main_comment'][$row['id_comment']] = $row['text'];
            } else {
                $comments['answer_comment'][$row['answer_id_comment']][] = [
                    'id_comment' => $row['id_comment'],
                    'text' => $row['text']
                ];
                
            }
        }
        return $comments;
    }

    public function insertComment($id_comment, $text){
        $this->startTransaction();
        try {
            $this->insert('comments', ['answer_id_comment' => $id_comment, 'text' => $text]);
            $this->commitTransaction();
            return true;
        } catch (Exception $e) {
            $this->rollBackTransaction();
            return false;
        }
    }

    public function updateComment($id_comment, $text){
        try {
            $this->update('comments', ['text' => $text], 'id_comment = '. $id_comment);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectInfo($flagInsert, $flagUpdate){
        $blade = new Blade(__DIR__ . '/resources/views', __DIR__ . '/resources/cache');

        $main = [
            'title' => 'Комментарий',
            'insert' => $flagInsert,
            'update' => $flagUpdate,
            'comments' => $this->selectAllComments()
        ];

        echo $blade->render('comment_page', $main);
    }
}

$flagInsert = false;
$flagUpdate = false;
$comments = new workWithComment();

if (!empty($_POST)){
    $edit = (int)$_POST['edit'];
    $id_comment = (int)$_POST['id_comment'];
    $text = htmlspecialchars($_POST['text']);

    switch( $edit ){
        case 0:
        case 2:
            $flagInsert = $comments->insertComment($id_comment, $text);
            break;
        case 1:
            $flagUpdate = $comments->updateComment($id_comment, $text);
            break;
    }
}

$comments->selectInfo($flagInsert, $flagUpdate);
