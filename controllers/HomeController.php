<?php

namespace Controllers;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        require '../includes/auth-guard.php';
        parent::__construct();
    }
    
    /**
     * Show the dashboard.
     */
    public function index()
    {
        $posts = $this->getPost();

        view('home', compact('posts'));
    }

    /**
     * Get post from database.
     *
     * @return array|null
     */
    private function getPost(): array
    {
        $sql = /** @lang text */
            'SELECT * FROM posts';

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}