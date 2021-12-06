<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prof;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct(Post $post)
    {
        // İnitialize user property.
        $this->post = $post;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Request()->validate([
            'code' => 'required|unique:posts,code,'.Request()->id,
            'task' => 'required',
            'points' => 'required|integer',
            'prof_id' => 'required',
        ], [
            'code.required' => 'Wajib Isi!!',
            'task.required' => 'Wajib Isi!!',
            'points.required' => 'Wajib Isi!!',
            'prof_id.required' => 'Wajib Isi!!',
        ]);
        $insert_data = [
            'code' => Request()->code,
            'task' => Request()->task,
            'points' => Request()->points,
            'prof_id' => Request()->prof_id,
        ];
        $this->post->insertData($insert_data);
        return redirect()->back()->with('pesan', 'Data Berhasil Ditambahkan!!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $joblist = Post::all();
        $prof_list = Prof::all();
        return view('pages.admin.mjob',compact('joblist','prof_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_post = $this->post->find($id);
        if (Request()->code == $data_post->code &&
        Request()->task == $data_post->task &&
        Request()->points == $data_post->points 
        ) {
            return redirect()->back()->with('sama','Data Tidak Berubah!!');
        } else {
            Request()->validate([
                'code' => 'required|unique:posts,code,'.Request()->id,
                'task' => 'required',
                'points' => 'required|integer',
                'prof_id' => 'required',
            ], [
                'code.required' => 'Wajib Isi!!',
                'task.required' => 'Wajib Isi!!',
                'points.required' => 'Wajib Isi!!',
                'prof_id.required' => 'Wajib Isi!!',
            ]);
            $update_data = [
                'code' => Request()->code,
                'task' => Request()->task,
                'points' => Request()->points,
                'prof_id' => Request()->prof_id,
            ];
            $this->post->editData($id,$update_data);
            return redirect()->back()->with('pesan', 'Data Berhasil Ditambahkan!!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->post->deleteData($id);
        DB::statement("ALTER TABLE posts AUTO_INCREMENT = 1;");
        return redirect()->back()->with('pesan', 'Data Berhasil Dihapus!!!');
    }
}
