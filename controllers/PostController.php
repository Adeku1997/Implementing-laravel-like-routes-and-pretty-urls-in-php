<?php

namespace Controllers;

use Models\Comment;
use Models\Post;
use Models\User;

/**
 * Class PostController
 */
class PostController extends Controller
{
    /**
     * Fetch a particular post from storage using the given id.
     *
     * @param array $request
     */
    public function show(array $request)
    {
        $post = (new Post())->find($request['post_id']);

        ($post->user->name);

        $commentController = new CommentController();
        $myComments = $commentController->showComment($request['post_id']);

        view('show-post', compact('post', 'myComments'));
    }

    /**
     * show create page
     */
    public function createPosts()
    {
        view('create');
    }


    public function makePost(array $data)
    {
        //validatePost
        $this->validatePost($data);

        //storepost
        $this->storePost($data);
    }

    /**
     * validatePosts
     *
     * @param array $data
     * @param string $route
     */
    public function validatePost(array $data, string $route = 'post')
    {


        $errors = [];

        $title = $data['title'];
        $content = $data['content'];

        if (!$title) {
            $errors['title'] = 'this field cannot be left empty';
        }

        if (!$content) {
            $errors['content'] = 'this field cannot be left empty';
        }

        if (!count($errors)) {
            return;
        }

        fillErrorBag($errors);
        redirectTo($route);

    }

    /**
     * storePost in database
     * @param array $data
     */

    public function storePost(array $data)
    {

        $title = $data['title'];
        $content = $data['content'];
        $user_id = $_SESSION['user']->id;


        $sql = "INSERT INTO posts (title,content,user_id)
                               VALUES('$title','$content','$user_id')";

        $result = $this->conn->query($sql);

        redirectTo('post');
    }

    /**
     * Delete a post.
     *
     * @param array $data
     * @throws \Exception
     */
    public function deletePost(array $data)
    {
        (new Comment())->deleteWithCondition('post_id', $data['post_id']);

        (new Post())->find($data['post_id'])
            ->delete();

        redirectTo('home');
    }

    /**
     * Show update page.
     *
     * @param array $request
     */
    public function showUpdateForm(array $request)
    {
        $result = $this->conn->query(/** @lang text */ "Select * from posts where id = {$request['post_id']}");

        $article = $result->fetch_assoc();

        view('update', compact('article'));
    }

    public function updatePost(array $data)
    {
        $this->validatePost($data, "update?post_id={$data['post_id']}");

        $title = $data['title'];
        $content = $data['content'];

        $id = $data['post_id'];

        $sql = "UPDATE posts SET title='$title' ,content='$content'where id='$id'";

        $result = $this->conn->query($sql);

        redirectTo("home");

    }


}
