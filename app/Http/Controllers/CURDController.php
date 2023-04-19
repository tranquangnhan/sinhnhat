<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;

abstract class CURDController extends Controller
{
    /**
     * The attributes prefix for each model.
     *
     * @var string
     */
    protected string $prefix;
    protected string $files;

    /**
     * Init Repository
     * 
     * @var BaseRepository
     */
    protected BaseRepository $repository;

    /**
     * Construct function
     *
     * @return void
     */
    public function __construct()
    {
        $this->setRepository();
    }

    /**
     * Set repository
     * 
     * @return void
     */
    public function setRepository()
    {
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository
     * 
     * @return repository
     */
    public function getRepository()
    {
        $className = $this->prefix . 'Repository';
        $dir = "App\\Repositories\\$className";
        $class = new $dir;
        return $class;
    }

    /**
     * Show all
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->repository->getAll();
        // return view("$this->prefix.index", compact('posts'));
        return view( $this->files ."index", compact('posts'));
    }
    public function index2()
    {
        $posts = $this->repository->getAll();
        // return view("$this->prefix.index", compact('posts'));
        return view( $this->files ."index", compact('posts'));
    }
    /**
     * Show single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->find($id);

        return view( $this->files .'show', compact('post'));
    }

    /**
     * Create single post
     *
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->repository->create($data);

        return view('home.post', compact('post'));
    }

    /**
     * Update single post
     *
     * @param $request \Illuminate\Http\Request
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->repository->update($id, $data);

        return view('home.post', compact('post'));
    }

    /**
     * Delete single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return view('home.post');
    }
}
