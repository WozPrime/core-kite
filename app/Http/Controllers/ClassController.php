<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = Kelas::latest()->paginate(4);
        return view ('class.index', compact('class'))->with ('i', (request()->input('page', 1) -1) *4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('class.create');
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
        $r=$request->validate([
            'namakelas' => 'required',
            'keterangan' => 'required',
            'teacher' => 'required',
        ]);

        $classId = $request->class_id;
        Kelas::updateOrCreate (['id' => $classId],['namakelas' => $request->namakelas, 'keterangan' => $request->keterangan,'teacher'=>$request->teachers]);
        if(empty($request->class_id))
            $msg = 'Class entry created successfully.';
        else
            $msg = 'Class data is updated succesfully.';
            return redirect()->route('class.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $class)
    {
        //
        return view('class.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $class = Kelas::where($where)->first();
        return Response::json($class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $class = Kelas::where('id', $id) -> delete();
        return Response::json($class);
    }
}
