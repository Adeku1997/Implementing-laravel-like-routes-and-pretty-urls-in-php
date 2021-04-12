<?php


namespace Controllers;


class CommentController extends Controller
{
    /**
     * @param array $data
     */
    public function makeComment(array $data)
    {
        //validate comment
        $this->validateComment($data);

        //store comment
        $this->storeComment($data);

    }

    public function validateComment(array $data)
    {

        $errors = [];

        $comment = $data['comment'];

        if (!$comment) {
            $errors['comment'] = 'cannot be left empty';
        }


        if (!count($errors)) {
            return;
        }


        fillErrorBag($errors);

        redirectTo("show-post?post_id={$data['post']}");
    }

    public function storeComment(array $data)
    {
        $comment = $data['comment'];

        $user_id = $_SESSION['user']->id;
        $post_id = $data['post'];

        $sql = "INSERT INTO comments(comment,user_id,post_id)
                              VALUES ('$comment','$user_id','$post_id')";

        $result = $this->conn->query($sql);

        redirectTo("show-post?post_id={$data['post']}");
    }

    /**
     * @param int $post
     * @return mixed
     */
    public function showComment(int $post)
    {
        $sql = "SELECT name,comment, DATE_FORMAT(comments.created_at, '%Y-%m-%d') AS created_at FROM comments  INNER JOIN users ON comments.user_id=users.id where post_id=$post";

        $result = $this->conn->query($sql);

        return $result->fetch_all(true);

    }
}