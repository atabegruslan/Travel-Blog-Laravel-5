<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gcmtoken;

class GcmController extends Controller
{
    public function store(Request $request)
    {
    	try{
	        $this->validate($request, [
	            'token' => 'required|unique:gcmtokens',
	        ]); 

	        $gcmtoken = new Gcmtoken;
	        $gcmtoken->token = $request->input('token');
	        $gcmtoken->save();

            $response = [
                "msg" => "OK"
            ];
            $statusCode = 200;
            
        }catch(Exception $e){
            $response = [
                "error" => "Error"
            ];
            $statusCode = 404;
        }finally{
            return \Response::json($response, $statusCode); 
        }        
    }

    public function sendGcm($message)
    {
        $regIds = $this->getTokens();
        $apiKey = env('GCM_KEY');
        $url = env('GCM_URL');
        $gcmResult = $this->makePostRequest($url, $apiKey, $regIds, $message);
        return $gcmResult;
    }

    private function getTokens(){
        return Gcmtoken::pluck('token')->toArray();
    }

    /**
     * Make POST request to GCM server.
     *
     * @param  String  $id, String  $apiKey, String[]  $regIds, String  $message
     * @return $response:
     *  {
     *      "multicast_id":5283259417401696038,
     *      "success":0,
     *      "failure":2,
     *      "canonical_ids":0,
     *      "results":
     *          [
     *              {"error":"InvalidRegistration"},
     *              {"error":"InvalidRegistration"}
     *          ]
     *  }
     */
    private function makePostRequest($url, $apiKey, $regIds, $message)
    {    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);

        $header = array(                                                                          
            'Content-Type: application/json',                                                                                
            'Authorization: key=' . $apiKey                                                                      
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 

        $data = array(
            "registration_ids" => $regIds, 
            "data" => array(
                "message" => $message
            )
        );                                                                 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );   \

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $response = curl_exec($ch);

        // if($response == false){ 
        //     var_dump(curl_error($ch)); 
        // }

        curl_close($ch);

        return $response;        
    }

    private function makeGetRequest($url)
    {    
        $ch = curl_init();   
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);  
        // if($output == false){ 
        //     var_dump(curl_error($ch)); 
        // }
        curl_close($ch);
        return $output;
    }
}
