<?php

namespace App\Http\Controllers;

use App\Models\chatModel;
use App\Models\regModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class regCon extends Controller
{
    //data insert into table
    public function addData(Request $req)
    {
        //konsa value put karwana lazmi h wo if form me ye sab me value user put kare to age chale warna nh chale
        $req->validate([
            "name" => "required",
            "phone" => "required",
            "email" => "required",
            "password" => "required",
            "image" => "required",
        ]);

        // form ka saara data aik variable me store karne k liye jis sequence se form se data ayega usitara table k column me jayega isliye zaroori h k table me pehla column name h to form se bhi pehla data name aye agar email aya to wo name column me save hoga
        $data = $req->all();

        // image check if yes image insert
        if ($req->hasFile("image")) {
            $randname = rand(1000, 9999) . "." . $req->image->extension();
            $path = $req->image->storeAs("image", $randname, "public");
            $data["image"] = "storage/" . $path;
        }

        // data insert method
        $insertData = regModel::create($data);

        //check data insert or not create response
        if ($insertData) {
            return redirect("/registration")->with("success", "successfully data inserted...");
        } else {
            return redirect("/registration")->with("success", "Ooops something went wrong !!");
        }
    }

    // data fetch table to ui
    public function dataFetch()
    {
        //all data fetching to db method
        $data = regModel::all();

        //check data fetch or not create response
        if ($data) {
            return view("user", compact("data"));
        } else {
            return view("user")->with("success", "Data Not Found !!");
        }
    }

    //open edit form
    public function editForm($id)
    {
        //just one id data fetch to db & data is check in db data here or not take wohi data aye jo requst me h
        $data = regModel::find($id);

        //check if data fetch or not create response
        if ($data) {
            return view("editForm")->with("data", $data);
        } else {
            return view("user")->with("success", "Data Not Found !!");
        }
    }

    //data update in db
    public function updateData(Request $request, $id)
    {
        //just one id data fetch to db & data is check in db data here or not usi ka data update ho jiska request aya h
        $data = regModel::find($id);

        //if data in db
        if ($data) {

            //chech konsa data request me ara h ya nahi
            if ($request->name) {
                // data request me jo h usko purane wale data me overwrite kardo
                $data->name = $request->name;
            }
            if ($request->phone) {
                $data->phone = $request->phone;
            }
            if ($request->email) {
                $data->email = $request->email;
            }
            if ($request->password) {
                $data->password = $request->password;
            }
            // image check if yes image insert
            if ($request->hasFile("image")) {
                $randname = rand(1000, 9999) . "." . $request->image->extension();
                $path = $request->image->storeAs("image", $randname, "public");
                $data->image = "storage/" . $path;
            }
        }

        // data ko overwrite karne k baad usko store karde db me
        $dataSave = $data->save();

        //if update is done or not
        if ($dataSave) {
            return redirect("/userData")->with("success", "successfully data updated...");
        } else {
            return redirect("/userData")->with("success", " Data not updated !!");
        }
    }

    //delete data in db
    public function deleteData($id)
    {
        //data find in db
        $data = regModel::find($id);

        // data delete method
        $delete = $data->delete();
        //data if exists and delete method is work
        if ($delete) {
            return redirect("/userData")->with("success", "successfully data deleted...");
        } else {
            return redirect("/userData")->with("success", " Data not deleted !!");
        }
    }

    // user login into website
    public function userLogin(Request $req)
    {
        //konsa value put karwana lazmi h wo ye sab value put hona chahiye
        $req->validate([
            "email" => "required",
            "password" => "required",
        ]);

        // check between user put data or table data
        $data = regModel::where("email", "=", $req->email)->where("password", "=", $req->password)->first();

        // if data match or not
        if ($data) {
            // 1) yaha se is session me data store wo hotaa h jo sirf request se ata hai request me jo data hota wo store hota h

            // store in session all data just one variable in one session as associative array
            // $req->session()->put('user', $data);

            // store in session targeted data to separate variable in multiple session
            //  $req->session()->put('user_name', $data->name);
            //  $req->session()->put('user_password', $data->password);

            //1 yaha end

            // 2) is session me global session helper h isme koi bhi data store karsakte h request se data ana zaroori nh

            // store in session targeted data to separate variable with array syntax in one session
            //    session([
            //     'user_name' => $data->name,
            //     'user_email' => $data->email,
            //     'user_password' => $data->password
            // ]);

            // store in session all data to separate variable with array syntax in one session as associative array
            // jab session me aik variable me sara data store karte h to wo asso-array ki surate me save hota h
            session(['user' => $data]);
            return redirect("/dashboard")->with("success", "Congratulations !! you have successfully login...");
        } else {
            return redirect("/login")->with("success", "login has been unsuccessfull !!");
        }
    }

    //user logout
    public function userLogout()
    {

        //saara session destroy k liye
        // session()->flash("user");

        //forget se saara sesion bhi destroy karte h or targeted session bhi

        // forget se specific targeted item session se delete hoga or user. isliye k user k andar name ki key h or usme value save h
        // session()->forget(["user.name","user.email"]);

        // ye sirf aik item session se delete k lye use hota h agr poora session destroy karna h to jis me data h uska naam jaise user assoc-array h usme saara data array form me hai to user likh ke saara session destroy
        session()->forget("user");
        return redirect("/login")->with("success", "logout has been successfull !!");
    }

    //agar session me data he to hi dashboard khule warna login pe jaye (single page)
    // public function sessionCheck()
    // {
    //     if (session("user")) {
    //         return view("dash");
    //     } else {
    //         return redirect("/login")->with("success", "Login first!!");
    //     }
    // }

    //agar session me data he to hi dashboard khule warna login pe jaye (multiple page)
    public function sessionCheckDashboard()
    {
        return $this->sessionCheck("dashboard");
    }

    public function sessionCheckChat()
    {
        return $this->sessionCheck("chat");
    }

    private function sessionCheck($routeName)
    {
        if (session("user")) {
            if ($routeName === "dashboard") {
                return view("dash");
            } elseif ($routeName === "chat") {
                //data pass to view
                $data = regModel::all();
                return view("layout.chat")->with("data", $data);
            }
        } else {
            return redirect("/login")->with("success", "Login first!!");
        }
    }

    // chat person data to show chat screen
    public function chatPersonData($id)
    {
        if (session("user")) {
            //select specific user to use id
            $personData = regModel::find($id);

            // Get the session ID
            $sessionId = session("user")['id'];

            //show chat home screen between recv id and sndrid
            // Show chat home screen between the session ID and the parameter ID
            $chatData = chatModel::where(function ($query) use ($id, $sessionId) {
            $query->where('senderId', $sessionId)->where('receverId', $id)
            ->orWhere('senderId', $id)->where('receverId', $sessionId); })->get();

            if ($personData) {
                return view("layout.chat", compact("personData"))->with("chatData", $chatData);
            } else {
                return view("layout.chat")->with("success", "No Data Available...");
            }
        } else {
            return redirect("/login")->with("success", "Please Login To Chat!!");
        }
    }

//chat msg sender
    public function msgSender(Request $req)
    {
        $req->validate(["msg" => "required"]);
        $time = Carbon::now("Asia/Karachi")->format("h:i A");
        // jis sequence se form se data ayega usitara table k column me jayega agr form se name ka data pehle ara h or table me pehla column email h to wo email me save na ho isliye custom column ka naam likh h usme request ka data put kare
        $data = [
            "senderId" => $req->sndrid,
            "receverId" => $req->rcvid,
            "message" => $req->msg,
            "time" => $time
        ];

        $insertData = chatModel::create($data);

        //check data insert or not create response
        if ($insertData) {
            return redirect("/chatPerson/$req->rcvid");
        } else {
            return redirect("/chatPerson/$req->rcvid");
        }
    }

}
