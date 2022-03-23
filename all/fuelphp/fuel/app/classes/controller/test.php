<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
R::setup( 'mysql:host=localhost;dbname=posts',
		'root', '' );
class Controller_Test extends Controller_Rest
{
    
    public function get_list()
    {
        
        $albums = R::findAll("album");
        $itemRecords=array();
        $itemRecords["items"]=array();
        $itemRecords["records"]=R::count("album"); 
        foreach($albums as $album){

            $itemDetails=array(
                "id" => $album->id,
                "title" => $album->title,
                "artist" => $album->artist,
                "year" => $album->year,  		
            ); 
           array_push($itemRecords["items"], $itemDetails);

        }
        return $this->response($itemRecords);
    }
    

    public function post_create(){  
        $data = Input::post();       
        if(empty($data)){
            return  $this->response("empty");
        }
        else {
            $album = R::dispense("album");
            $album->title = $data['title'];
            $album->artist = $data['artist'];
            $album->year = $data['year'];
            $id = R::store( $album );
            return  $this->response($id);
        }
     }
     public function put_edit(){ 

            $data = Input::put();
            $album = R::dispense("album");
            $album->id = $data['id'];
            $album->title = $data['title'];
            $album->artist = $data['artist'];
            $album->year = $data['year'];
            $album->rating = $data['rating'];
            $id = R::store( $album );
            return  $this->response($id);     
     }
     public function delete_delete(){ 

        $data = Input::delete();
        $id = 5;
        $album = R::load("album", $id);

        R::trash( $album );
        return  $this->response($id);     
 }
}



