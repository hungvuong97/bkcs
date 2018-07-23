<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\sysadmin;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\function_admin;
use App\authorization;
use Illuminate\Foundation\Auth\User;
use App\device;
use App\Http\Controllers\mysqli_fetch_array;

class UserController extends Controller
{   
  /*  private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
 */  
    
   

    public function getAddAccount(){
        $account = sysadmin::all();
        $function = function_admin::all();
        $author = authorization::all();
        return view('page_admin.admin.addAccount',['account'=>$account,'function'=>$function,'author'=>$author]);
    }

    public function postAddAccount(Request $request){
      $this->validate($request,[
        'fullname'=>'required',
        'email'=>'required',
        'username'=>'required',
        'password'=>'required',
        'passwordAgain'=>'required|same:password',
 
      ],[
          'fullname.required'=>'ban chua nhap ho ten',
          'email.required'=>'bạn chưa nhập email',
          'username.required'=>'bạn chưa nhập password',
          'password.required'=>'bạn chưa nhập password',
          'passwordAgain.required'=>'bạn chưa nhập lại password',
          'passwordAgain.same'=>'mật khẩu không khớp',
      ]);

      $admin = new sysadmin;
      $admin->fullname = $request->fullname;
      $admin->mail = $request->email;
      $admin->adminId = $request->username;
      $admin->password = $request->password;
      
      
      
       $conn = mysqli_connect('localhost', 'root', '','bkcs');
          if (mysqli_connect_errno()){
            dd($conn);
          }
          mysqli_set_charset($conn, 'UTF8');
           $user="";

//Lấy giá trị POST từ form vừa submit
   
    if(isset($_POST["username"])){
      $user = $_POST["username"];
     // dd($user);
      $checkBox = $_POST['checkbox'];
      dd(count($checkBox));
    for ($i = 0; $i<count($checkBox); $i++){
      $sql = " INSERT INTO function_admin (adminId,rightId)
                            VALUES ('$user','$checkBox[$i]') ";
      $sql1 = mysqli_query($conn,$sql);
      dd($sql1);
      }
      mysqli_close($conn);
        $admin->save();
      return redirect('addAccount')->with('thong bao','them tai khoan thanh cong');
    }
  
}
    

    public function getLogin(){

        return view('page_admin.admin.dangnhap');
    }


    public function postLogin(Request $request){
        $this->validate($request,[
            'tendn'=>'required',
            'password'=>'required|min:3|max:32',
        ],[
            'tendn.required'=>'Ban chưa nhập tên đăng nhập',
            'pass.required' =>'Bạn chưa nhập mật khẩu',
            'pass.min'=>'Mật khẩu quá ngắn',
            'pass.max'=>'Mật khẩu quá dài',
        ]);
   if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
           $u = $p = "";
            if(isset($_POST['tendn']) ) 
              $u = $_POST['tendn'];
      
          if(isset($_POST['password']))
               $p=$_POST['password'];
          if($u && $p){ 
            $conn=mysqli_connect("localhost","root","","bkcs") or die("can't connect this database");
            mysqli_select_db($conn,"sysadmin");
            $sql="select * from sysadmin where adminId='".$u."' and password='".$p."'";
            $query=mysqli_query($conn,$sql);
            if(mysqli_num_rows($query) == 0) 
           echo "Username or password is not correct, please try again";
          else
          {
            /* $row=mysqli_fetch_array($query);
             session_start();
              $_SESSION['$u'] = $row[id];
              $_SESSION['$p'] = $row[level];
            */return redirect ('addAccount');
         }
                  }
                          }
  
    
}
   
 
    public function getLogout(){
        Auth::logout();
        return redirect('dangnhap');
    }

 
    public function getAccountList(){
         $user = sysadmin::all();
         $author = authorization::all();
         $function = function_admin::all();
        return view('page_admin.admin.accountList',['user'=>$user,'author'=>$author,'function'=>$function]);
    }
    
    public function getEditAccount($adminId){
     
        $account = DB::table('sysadmin')->where('adminId',$adminId)->first();
      //  $account = sysadmin::find($adminId);
        $function = function_admin::all();
        $author = authorization::all();
      return view('page_admin.admin.editAccount',['account'=>$account,'function'=>$function,'author'=>$author]);
    }

    public function postEditAccount(Request $request, $adminId){
      $this->validate($request,[
        'fullname'=>'required',
        'email'=>'required',
        'username'=>'required',
        'password'=>'required',
        'passwordAgain'=>'required|same:password',
 
      ],[
          'fullname.required'=>'ban chua nhap ho ten',
          'email.required'=>'bạn chưa nhập email',
          'username.required'=>'bạn chưa nhập password',
          'password.required'=>'bạn chưa nhập password',
          'passwordAgain.required'=>'bạn chưa nhập lại password',
          'passwordAgain.same'=>'mật khẩu không khớp',
      ]);
      $admin = DB::table('sysadmin')->where('adminId',$adminId)->update(['fullname'=>$request->fullname,'mail'=>$request->email,'adminId'=>$request->username,'password'=>$request->password]);
    //  $admin->fullname = $request->fullname;
    //  $admin->mail = $request->email;
    //  $admin->adminId = $request->username;
    //  $admin->password = $request->password;
    //  $admin->save();
          $conn = mysqli_connect('localhost', 'root', '','bkcs');
          mysqli_set_charset($conn, 'UTF8');
           $user="";

//Lấy giá trị POST từ form vừa submit
   
    if(isset($_POST["username"])){
      $user = $_POST['username']; 
      $checkBox = $_POST['checkbox'];
    for ($i = 0; $i<count($checkBox); $i++){
      $sql = " INSERT INTO function_admin(adminId,rightId)
                            VALUES ('$user','$checkBox[$i]') ";
      mysqli_query($conn,$sql);
      }
      mysqli_close($conn);
      return redirect('accountList')->with('thong bao','them tai khoan thanh cong');
      
    }
  }

   public function getDeviceList(){
        return view('page_admin.admin.deviceList');
   }


   public function getManageDevice(){
        //  $user = sysadmin::all();
    //      $function = DB::table('function_admin')->select('adminId')->get();
     //     print_r($function);
         // var_dump($function->adminId);
       //  echo $function->adminId;
         $user = array();
           $device = device::all();
          $conn = mysqli_connect('localhost', 'root', '','bkcs');
          mysqli_set_charset($conn, 'UTF8');
          $sql = 'SELECT adminId FROM function_admin Where rightId = "quản lý cấu hình" ';
          $result = $conn->query($sql);
        // var_dump($result);
          $row = mysqli_fetch_array($result,MYSQLI_NUM);
     //    dd($row);
         foreach($row as $r){
          //dd($r);
         $sql1 = "SELECT fullname FROM sysadmin where adminId = '$r'";
         //echo $sql1;
         $result = $conn->query($sql1);
         if($result->num_rows >0){
          while($row=$result->fetch_assoc()){
            dd($row["fullname"]);
          }
         }
       }


      //   $user = mysqli_fetch_array($user,MYSQLI_NUM);
        
          $conn->close();
        return view('page_admin.admin.manageDevice',["user"=>$user,"device"=>$device]);
}   

}