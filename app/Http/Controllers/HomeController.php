<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendList;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('home', compact('users'));
    }

    public function search_friend()
    {
        $usersLst = FriendList::with('users')->where('user_id','=', auth()->user()->id)->get();
        
        return view('search_friend', compact('usersLst'));
    }

    public function match_friend()
    {
        $user = auth()->user();

        $userArray = [
            'age' => $user['dob'],
            'country' => $user['country'],
            'favorite_color' => $user['favorite_color'],
            'favorite_actor' => $user['favorite_actor'],
        ];

        $match_users = FriendList::with('users')->where('user_id','=', auth()->user()->id)->get();

        $matchUserArr[] = "";
        foreach($match_users as $match_usr)
        {
            $match_usr['percentage'] = 0;
            if($user['id'] != $match_usr->users->id)
            {
                if($user['dob'] == $match_usr->users->dob)
                {
                    $match_usr['percentage'] += 25;
                }
                if($user['country'] == $match_usr->users->country)
                {
                    $match_usr['percentage'] += 25;
                }
                if($user['favorite_color'] == $match_usr->users->favorite_color)
                {
                    $match_usr['percentage'] += 25;
                }
                if($user['favorite_actor'] == $match_usr->users->favorite_actor)
                {
                    $match_usr['percentage'] += 25;
                }

                $matchUserArr[] = $match_usr;
            }
        }

        $match_friends = array_filter($matchUserArr);
        return view('match_friend', compact('match_friends'));
    }

    public function search_gender(Request $request)
    {
        $gender = $request->gender;
        $searchGender = User::where('gender', 'LIKE', $gender.'%')->whereNotIn('id', '=',auth()->user()->id)->get();
        return response($searchGender);
    }

    public function search_dob(Request $request)
    {
        $dob = $request->dob;
        $searchGender = User::where('dob', 'LIKE', $dob.'%')->whereNotIn('id', '=',auth()->user()->id)->get();
        // dd($searchGender);
        return response($searchGender);
    }

    public function search_color(Request $request)
    {
        $color = $request->color;
        $searchColor = User::where('favorite_color', 'LIKE', $color.'%')->whereNotIn('id', '=',auth()->user()->id)->get();
        return response($searchColor);
    }

    public function search_actor(Request $request)
    {
        $actor = $request->actor;
        $searchActor = User::where('favorite_actor', 'LIKE', $actor.'%')->whereNotIn('id', '=',auth()->user()->id)->get();
        // dd($searchActor);
        return response($searchActor);
    }

    public function user_profile($id)
    {
        $profile = User::with('users:id,friend_id,user_id')->where('id', '=', $id)->first();
        return view('user_profile', compact('profile'));
    }

    public function add_friend(Request $request)
    {
        $userId = auth()->user()->id;

        $user = FriendList::where('friend_id', '=', $request->friendId)->where('user_id','=',$userId)->first();

        if ($user === null)
        {
            $addFriend = new FriendList();
            $addFriend->user_id = $userId;
            $addFriend->friend_id = $request->friendId;
            $addFriend->save();
        }

        return response('success');
    }
}
