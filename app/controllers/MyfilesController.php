<?php

class MyfilesController extends \BaseController 
{
    public function myfiles() 
    {
        //$files = Myfile::where('user_id', '=', Auth::user()->id)->get();
        $files = Auth::user()->myfiles;
        
        //$files is passed to the view file myfiles.blade.php
        $data = array('files' => $files);
        return View::make('users.myfiles', $data);
    }

    public function uploadfile() 
    {
        //Determining if the file was uploaded 
        if (Input::hasFile('uploadfile'))
        {
            //Retrieving an uploaded file
            $data = Input::file('uploadfile');
            $path = public_path() . '/gallery/' . Auth::user()->id; // upload directory

            // get uploaded file extension
            //$ext = $file['extension'];
            $ext = $data->guessClientExtension();
            
            // get size
            $size = $data->getClientSize();

            // looking for format and size validity
            $name = $data->getClientOriginalName();

            // If directory exists
            if(!file_exists($path))
            {
                $old_umask = umask(0);
                $fs = new Illuminate\Filesystem\Filesystem();
                $fs->makeDirectory($path, 0777, TRUE);
                umask($old_umask);
            }
            
            //to insert uploaded data to the Database
            if($data->move($path, $name))
            {
                $thumbnail_path =  public_path() . '/thumbnail/' . Auth::user()->id;
                //print_r($thumbnail_path); exit;
                if(!file_exists($thumbnail_path))
                {
                    $old_umask = umask(0);
                    $fs = new Illuminate\Filesystem\Filesystem();
                    $fs->makeDirectory($thumbnail_path, 0777, TRUE);
                    umask($old_umask);
                }
                
                $file_obj = new Myfile();
                    
                //upload PDF or DOC file
                if(($ext === 'pdf') || ($ext === 'doc'))
                {
                    $file_obj->file_name = $name;
                    $file_obj->file_type = $data->getClientOriginalExtension();
                    $file_obj->file_path = '/gallery/' . Auth::user()->id . '/' . $name;
                    //$file_obj->thumbnail_path = NULL;
                    $file_obj->user_id = Auth::user()->id;
                    $file_obj->save();
                }
                else 
                {
                    //conversion to thumbnail
                    $file_path = public_path() . '/gallery/' . Auth::user()->id . '/' . $name;
                    App::make('phpthumb')
                        ->create('crop', array($file_path, 'center', 200, 200))
                        ->save($thumbnail_path . '/');

                    $file_obj = new Myfile();
                    $file_obj->file_name = $name;
                    $file_obj->file_type = $data->getClientOriginalExtension();
                    $file_obj->file_path = '/gallery/' . Auth::user()->id . '/' . $name;
                    $file_obj->thumbnail_path = '/thumbnail/' . Auth::user()->id . '/' . $name;
                    $file_obj->user_id = Auth::user()->id;
                    $file_obj->save();
                }
            }
            
            return Redirect::route('myfiles');
            
        }  
        else
        {
            $msg = new \Illuminate\Support\MessageBag();
            $msg->add('upload_image', 'A file is required.');
            return Redirect::route('myfiles')->withErrors($msg)->withInput();
        }             
    }

    /**
     * Display a listing of the resource.
     * GET /myfiles
     *
     * @return Response
     */
    public function index()
    {
            //
    }

    /**
     * Show the form for creating a new resource.
     * GET /myfiles/create
     *
     * @return Response
     */
    public function create()
    {
            //
    }

    /**
     * Store a newly created resource in storage.
     * POST /myfiles
     *
     * @return Response
     */
    public function store()
    {
            //
    }

    /**
     * Display the specified resource.
     * GET /myfiles/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
            //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /myfiles/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
            //
    }

    /**
     * Update the specified resource in storage.
     * PUT /myfiles/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
            //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /myfiles/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
            //
    }

}