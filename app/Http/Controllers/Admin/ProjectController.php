<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Type;
use App\Models\Admin\Technology;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Project::All();
        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technology = Technology::all();

        return view('admin.create', compact('types', 'technology'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // $request->validate([
        //     'title'=>'required|unique:projects|max:100'
        // ],
        // [
        //    'title.required'=>'Il campo è obbligatorio',
        //    'title.unique'=>'Il dato è già presente',
        //    'title-max'=>'Il titolo supera il valore massimo' 
        // ]);

        $form_data = $request->all();
        
        //$new_project = new Project();
        //$new_project->fill($form_data);

        if ($request->hasFile('path')) {
            //     //Genere un path di dove verrà salvata l'iimagine nel progetto
            $img_path = Storage::disk('public')->put('uploads', $request['path']);

            $form_data['path'] = $img_path;
        }

        $create = Project::create($form_data);

        if( $request->has('technology') ){
            $create ->technologies()->attach($request->technology);
           }

        $create->save();

        return redirect()->route('admin.index.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $project = Project::find($id);
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mod_post =  Project::find($id);
        $types = Type::all();
        $technology = Technology::all();
        return view('admin.edit', compact('mod_post','types','technology'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // $request->validate([
        //     'title'=>'required|unique:projects|max:100'
        // ],
        // [
        //     'title.required'=>'Il campo è obbligatorio',
        //     'title.unique'=>'Il dato è già presente',
        //     'title-max'=>'Il titolo supera il valore massimo' 
        //  ]);
        $mod_post = Project::find($id);
        //dd($mod_post);
        $form_data = $request->all();

        if ($request->hasFile('path')) {
            if( $mod_post->path ){
                Storage::delete($mod_post->path);
            }

            //     //Genere un path di dove verrà salvata l'iimagine nel progetto
            $img_path = Storage::disk('public')->put('uploads', $request['path']);

            $form_data['path'] = $img_path;
        }
        
        $mod_post->update($form_data);

        if( $request->has('technology') ){
            $mod_post ->technologies()->sync($request->technology);
        
        }elseif(!$request->has('technologies')){
            $mod_post->technologies()->sync([]);                

        }



        // if( $request->hasFile('path') ){


        //     if( $post->path ){
        //         Storage::delete($post->path);
        //     }


        //     //Genere un path di dove verrà salvata l'iimagine nel progetto
        //     $path = Storage::disk('public')->put( 'post_images', $request->path );

        //     $form_data['path'] = $path;
        // }



        return redirect()->route('admin.index.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if( $post->path ){
        //     Storage::delete($post->path);
        // } 

        $mod_post =  Project::find($id);
        $mod_post->technologies()->sync([]);
        $mod_post->delete();
        return redirect()->route('admin.index.index');
    }
}
