<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notes;
use Validator;
use guard;
use Tymon\JWTAuth\JWT;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Symfony\Component\Mime\Message;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Claims\Subject;
use Exception;
use App\Http\Controllers\PasswordResetRequestController;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\Model;




class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *Middleware acts as a bridge between a request and a response. 
     * It is a type of filtering mechanism. .
     * @return void
     */
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function listUsers(){
        // echo "All notes";     
        // return Notes::all();
        // return Notes::find(4)->user;
        // return User::all();
        // return User::find(30);
        // return Notes::all();
        // return User::find(32)->noteses;      //-->32 user id notes
        // return Notes::all();                 //-->all notes
        return Notes::find(5)->user;          //-->finfing user
      
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|between:2,15',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            // 'firstname'=>'required|string',
            // 'lastname'=>'required|string',
            // // 'name'=>'required|string|between:2,15',
            // 'username'=>'required|email|unique:users',
            // 'password'=>'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            ]);

        $user = new User([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> bcrypt($request->input('password'))
            // 'firstname'=>$request->input('firstname'),
            //     'lastname'=>$request->input('lastname'),
            // 'username'=> $request->input('email'),
            // // 'email'=> $request->input('email'),
            // 'password'=> bcrypt($request->input('password'))
        ]);
        
        $user->save();
        return response()->json(['message'=>'Successfully Created user'],201);
    
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
        return response()->json([
            'token' => $token
        ], 200);
    }
    public function getUser(){
        $user = auth('api')->user();
        auth()->id();
        return response()->json(['user'=>$user], 201);

    }
    // public function logout() {
    //     auth()->logout();

    //     return response()->json(['message' => 'User successfully signed out']);
    // }



 /* --------------------------------- previous code------------------------------
    public function login(Request $request){
        //make The make method will return an instance of the class or interface you request.
        // Where you request to make an interface
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            
        ]);

        if ($validator->fails()) {
            //422 Unprocessable Entity
            return response()->json($validator->errors(), 422);              
        }
        
        //The attempt method accepts an array of key / value pairs as its first argument. 
        //The values in the array will be used to find the user in your database table.
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
           
        }   
            return $this->createNewToken($token);
    }
  
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,15',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|
                           regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);  
            //400-->server cannot or will not process the request due to something.
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);        //201-->request has been fullfilled
    }
    
     public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    
    public function userProfile() {
        return response()->json(auth()->user());
    }
    
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',   //hexadecimal form
            'expires_in' => auth()->factory()->getTTL() * 60,
            //This method is used to get the default time-to-live for the multicast packets which are sent out on the socket.
            //seeding fake data factory();
            'user' => auth()->user()
        ]);
    }
    
    protected function guard()
    {
        return Auth::guard();
    }
 */
}