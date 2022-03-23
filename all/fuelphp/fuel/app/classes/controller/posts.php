<?php

class Controller_Posts extends Controller
{

	public function action_index()
	{
		   $this->con();
		   $album = R::load( 'album', 4 );

		   echo $album->year;
           
        // return "hello from post controller";
        return Response::forge(View::forge('posts/index'));
		// return Response::forge(View::forge('welcome/index'));
		// return Response::forge(View::forge('welcome/index'));
	}

	
	public function action_hello()
	{
		
		// return "hello";
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}

	//	CONNECTION TO DATABASE
	public function con(){
		R::setup( 'mysql:host=localhost;dbname=posts',
		'root', '' ); //for both mysql or mariaDB
	}
}
