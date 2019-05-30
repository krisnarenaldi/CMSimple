<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\Superadmin;
use Auth;

use Carbon\Carbon;
use Image;
use File;

class SuperadminController extends Controller
{
    //
    protected $rules = ['name' => 'required|string|max:100',
                        'username' => 'required',
                        'email' => 'required|email'
                       ];
    
    protected $avatar_path = 'images/avatar/';
    protected $avatar_dimension = ['128'];
    
    protected $messages = [
        'name.required' => 'Mohon isi nama.',            
        'name.max' => 'Jumlah maksimal karakter adalah 100.',
        'username.required' => 'Mohon isi username.',            
        'username.unique' => 'Username sudah ada.',
        'email.required' => 'Mohon isi Email.',
        'email.email' => 'Mohon isi email yang valid.',
        'email.unique' => 'Email sudah ada.',
        'password.required' => 'Mohon isi password.',
        'password.confirmed' => 'Password tidak sama.'
    ];


    public function __construct(){
        $this->middleware("auth:superadmin");

    }

    public function index(){
        return view("superadmin.dashboard");
    }
    
    public function mytable(){
        return view("superadmin.tables");
    }


    /**
     * 
     * Profile Superadmin
     * Activity: update bio data and password
     */
    public function profile(){        
        
        $superadmin = Superadmin::findorFail(Auth::guard('superadmin')->user()->id);        
        $data = ["data" => compact("superadmin")];        
        $avatar = Auth::guard('superadmin')->user()->avatar;
        
        if($avatar == "" || is_null($avatar)){            
            $initial = getinitial($superadmin->name);
            $avatar_color = avatar_colors(intval(Auth::guard('superadmin')->user()->id) - 1);
            $data["avatar_color"] = $avatar_color;
            $data["initial"] = $initial;
        }                 
        return view("superadmin.profile",$data);
    }

    public function updateprofile(Request $request){
        
        $superadmin = Superadmin::findorFail(Auth::guard('superadmin')->user()->id);
        $credentials = [];
        $old_filename_out = $old_filename_in = $fileName = "";

        $name = $request->get("name");
        $username = $request->get("username");
        $email = $request->get("email");
        $current_password = $request->get("current_password");
        $password = $request->get("password");

        //avatar
        if($request->file('image')){            
            $this->validate($request,[
                'image' => 'bail|image|mimes:jpg,png,jpeg,svg'
            ],[
                'image.image' => 'Mohon upload tipe file jpg, png, jpeg,svg',
                'image.mimes' => 'Mohon upload tipe file jpg, png, jpeg,svg'
            ]);

            $file = $request->file('image');
            $fullname = strtolower(str_replace(" ","",Auth::guard('superadmin')->user()->name));
            $fileName = $fullname.'_'.Carbon::now()->timestamp.'.'.$file->getClientOriginalExtension();
            $old_filename_out =  public_path($this->avatar_path .$superadmin->avatar); 

            //hapus file lama terluar
            if(File::exists($old_filename_out)){                    
                File::delete($old_filename_out);
            }
            
            //upload original file
            Image::make($file)->save($this->avatar_path.$fileName);

            foreach($this->avatar_dimension as $row){
                $canvas = Image::canvas($row,$row);

                $resizeImage = Image::make($file)->resize($row,$row,function($constraint){
                    $constraint->aspectRatio();
                });

                //CEK JIKA FOLDERNYA BELUM ADA
                if (!File::isDirectory(public_path($this->avatar_path) . $row)) {
                    //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                    File::makeDirectory(public_path($this->avatar_path) . $row);
                }

                //hapus file lama di dalam                
                $old_filename_in = public_path($this->avatar_path . $row . '/'.$superadmin->avatar);

                if(File::exists($old_filename_in)){                    
                    File::delete($old_filename_in);
                }

                $canvas->insert($resizeImage,'center');
                //save the resized image
                $canvas->save(public_path($this->avatar_path) . $row . '/' . $fileName);
            }
        }
        
        if($username != $superadmin->username){
            $this->rules['username'] = 'required|unique:superadmins';
        }

        if($email != $superadmin->email){
            $this->rules['email'] = 'required|email|unique:superadmins';
        }

        if($current_password !=""){    
            $credentials = [
                'username' => $username,
                'password' => $current_password
            ];
            if(Auth::guard('superadmin')->attempt($credentials)==false){
                return back()->withErrors(["Password lama tidak ditemukan"])->withInput();
                die();
            }            
            $this->rules['password'] = 'required|confirmed';                                    
        }        
        $this->validate($request,$this->rules,$this->messages);

        $superadmin->name = $name;
        $superadmin->username = $username;
        $superadmin->email = $email;
        if($current_password !=""){
            $superadmin->password = Hash::make($password);
        }
        if($fileName !=""){
            $superadmin->avatar = $fileName;
        }
        $superadmin->save();
        
        $request->session()->flash("alert-success","Data Profile  berhasil di-update!");

        return redirect()->route('superadmin.profile');
        
    }

    protected function getinitial($name){
        $expr = '/(?<=\s|^)[a-z]/i';
	
        preg_match_all($expr,$name,$matches);
        
        return implode('',$matches[0]);
    }
    
}
