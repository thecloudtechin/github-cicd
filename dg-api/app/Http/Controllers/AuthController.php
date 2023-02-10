<?php

namespace App\Http\Controllers;
use App\HomeOffer;
use App\Restaurants;
use App\EmpLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\User;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->first_name = $request->input('first_name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'.$e], 409);
        }

    }


  public function Social_Media_Login(Request $request)
    {
        $request->request->add(['password' => 'weetech']);
        $user = DB::table('users')->where('email', $request->input('email'))->first();

        // echo $user->email;

        if ($user == null) {

            try {

                $user = new User;
                $user->first_name = $request->input('first_name');
                $user->email = $request->input('email');
                $plainPassword = 'weetech';
                $user->password = app('hash')->make($plainPassword);

                $user->save();

                $credentials = $request->only(['email', 'password']);
                if (!$token = Auth::attempt($credentials)) {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }
                    return response()->json(['status' => "success",
                        "id" => $user->id,
                        "first_name" => $user->first_name,
                        "email" => $user->email,
                        'token' => $token]);


            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'User Registration Failed!' . $e], 409);
            }
        }
        else{


            $credentials = $request->only(['email', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
                return response()->json(['status' => "success",
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "email" => $user->email,
                    'token' => $token]);


        }

    }

public function empLogout (Request $request)
    {
        $data = $request->All();
        $user = EmpLogin::where(['id' => $data['id']])->update(['token' => NULL]);
        return response()->json(['status'=> "success", 'result' => $user]);
    }

  public function checkContactExists( $number)
    {
        $user = User::where('mobile', '=', $number)->first();

        //  return response()->$user->count;
        return response()->json($user, 200);

    }

    public function Emp_Login_register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'emp_id' => 'required|unique:emp_logins',
            'password' => 'required|confirmed',
            'hotel_id' => 'required',
        ]);

        try {

            $user = new EmpLogin;
            $user->emp_id = $request->input('emp_id');
            $user->hotel_id = $request->input('hotel_id');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'.$e], 409);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where('email', $request->input('email'))->first();
        if(Hash::check($request->input('password'), $user->password)){

            $credentials = $request->only(['email', 'password']);
                    if (! $token = Auth::attempt($credentials)) {
                        return response()->json(['message' => 'Unauthorized'], 401);
                    }
                    // return $this->respondWithToken($user);
                    
                   
                    
                    return response()->json(['status'=> "success",
                    "id"=>$user->id,
                    "first_name"=>$user->first_name,
                    "email"=>$user->email,
                    "mobile"=>$user->mobile,
                    'token'=>$token]);
        }
        else{
            return response()->json(['status'=> "Failed"]);
        }


    }



public function otpLogin(Request $request)
    {
          //validate incoming request
        $this->validate($request, [
            'mobile' => 'required|string',
            'otp' => 'required|string',
        ]);


        $user = User::where('mobile', $request->input('mobile'))->first();
        if($request->input('otp') ==  $user->otp){

            $credentials = $request->only(['mobile', 'otp']);
                    if (! $token = Auth::attempt($credentials)) {
                        return response()->json(['message' => 'Unauthorized'], 401);
                    }
                    // return $this->respondWithToken($user);
                    
                   
                    
                    return response()->json(['status'=> "success",
                    "id"=>$user->id,
                    "first_name"=>$user->first_name,
                    "email"=>$user->email,
                    "mobile"=>$user->mobile,
                    'token'=>$token]);
        }
        else{
            return response()->json(['status'=> "Failed"]);
        }


    }

    public function Emp_Login(Request $request)
    {
          //validate incoming request
        $this->validate($request, [
            'emp_id' => 'required|string',
            'password' => 'required|string',
             'token' => 'required|string',
        ]);


        $user = EmpLogin::where('emp_id', $request->input('emp_id'))->first();
        if(Hash::check($request->input('password'), $user->password)){
            
             EmpLogin::where('id',$user->id)->update(array('token' => $request->input('token')));


                    return response()->json(['status'=> "success",
                    "id"=>$user->id,
                    "emp_id"=>$user->emp_id,
                    "for"=>$user->hotel_id,
                    "hotel_id"=> Restaurants::where('id', $user->hotel_id)->first()
                    ]);
        }
        else{
            return response()->json(['status'=> "Failed"]);
        }


    }

    public function getAllCount()
    {
        return response()->json(['status'=> "success",
        'orders'=> DB::table('orders')
        ->get()->count(),
        'restaurants'=> DB::table('restaurants')->get()->count(),
        'users'=> DB::table('users')->where('status', '=', '0')
        ->get()->count(),
         'offers' => HomeOffer::all()
        ]);

    }



    // public function logout( Request $request ) {

    //     $token = $request->header( 'Authorization' );

    //     try {
    //         JWTAuth::parseToken()->invalidate( $token );



    //         return response()->json( [
    //             'error'   => false,
    //             'message' => trans( 'auth.logged_out' )
    //         ] );
    //     } catch ( TokenExpiredException $exception ) {
    //         return response()->json( [
    //             'error'   => true,
    //             'message' => trans( 'auth.token.expired' )

    //         ], 401 );
    //     } catch ( TokenInvalidException $exception ) {
    //         return response()->json( [
    //             'error'   => true,
    //             'message' => trans( 'auth.token.invalid' )
    //         ], 401 );

    //     } catch ( JWTException $exception ) {
    //         return response()->json( [
    //             'error'   => true,
    //             'message' => trans( 'auth.token.missing' )
    //         ], 500 );
    //     }
    // }





}
