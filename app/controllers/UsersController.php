<?php

class UsersController extends \BaseController 
{

    public function login()
    {
        return View::make('users.login');
    }

    public function handleLogin()
    {
        $data = Input::only(['email', 'password']);

        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email|min:8',
                'password' => 'required',
            ]
        );

        if($validator->fails())
        {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            return Redirect::to('profile');
        }

        return Redirect::route('login')->withInput();
    }

    public function profile()
    {
        return View::make('users.profile');            
    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
        }

        return Redirect::route('login');
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
            return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::only(['first_name','last_name','email','password', 'password_confirmation']);

        $validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:4',
                'email' => 'required|email|min:5',
                'password' => 'required|min:5|confirmed',
                'password_confirmation'=> 'required|min:5'
            ]
        );

        if($validator->fails())
        {
            return Redirect::route('create')->withErrors($validator)->withInput();
        }

        $data['password'] = Hash::make($data['password']);
        $newUser = User::create($data);
        if($newUser)
        {
            Auth::login($newUser);
            return Redirect::route('profile');
        }

        return Redirect::route('create')->withInput();
    }

    public function uploadimage()
    {
        //Determining if the file was uploaded 
        if (Input::hasFile('upload_image'))
        {
            //Retrieving an uploaded file
            $data = Input::file('upload_image');

            $path = public_path() . '/image/'; // upload directory
            // get uploaded file extension
            //$ext = $file['extension'];
            $ext = $data->guessClientExtension();
            // get size
            $size = $data->getClientSize();
            // looking for format and size validity
            $name = Auth::user()->first_name;           //saves with logged-in user name
            //$name = $data->getClientOriginalName();   //saves with original file name
            $data->move($path, $name);
            $user = Auth::user();

            $user->image = "/image/{$name}";
            $user->save();
            return Redirect::route('profile');
        }  
        else
        {
            $msg = new \Illuminate\Support\MessageBag();
            $msg->add('upload_image', 'A file is required.');
            return Redirect::route('profile')->withErrors($msg)->withInput();
        }
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
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
     * GET /users/{id}/edit
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
     * PUT /users/{id}
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
     * DELETE /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
            //
    }

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
            //
    }

}