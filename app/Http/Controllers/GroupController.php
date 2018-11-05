<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupRegistrationNotification;
use App\Notifications\GroupInvitation;
use App\Notifications\GroupPartecipation;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::with('users')
            ->whereHas('users', function ($query) {
                $query->where('users.id', Auth::user()->id);
            })->get();

        $groupsRole = collect([]);
        $groups->each(function ($item, $key) use ($groupsRole) {
            $item->users->map(function ($item, $key) use ($groupsRole) {
                if ($item->id === Auth::user()->id)
                    $groupsRole->push($item->pivot->role);
            });
        });

        return view('groups.index', compact(
            'groups',
            'groupsRole'
        ));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:80',
            'description' => 'required|min:2|max:1000'
        ]);
        $group = new Group();
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store(
                'groups_image', 'public'
            );
            $group->image_url = $path;
        }
        $group->privacy = $request->get('privacy');
        $group->save();
        $group->users()->attach(Auth::user()->id, ['role' => 'super_administrator']);
        return redirect()->route('groups.index')->with('status', 'The group data has been updated!');
    }

    public function edit($id){
        $group = Group::find($id);
        return view('groups.edit' , ['group' => $group]);
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:80',
            'description' => 'required|min:2|max:1000'
        ]);
        $group = Group::find($request->get('id'));
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store(
                'groups_image', 'public'
            );
            $group->image_url = $path;
        }
        $group->privacy = $request->get('privacy');
        $group->save();
        return redirect()->route('groups.index')->with('status', 'Group data updated!');
    }

    public function show($id)
    {
        $group = Group::with(['users', 'publications'])->find($id);


        $publications = \App\Publication::with(['authors', 'topics', 'groups'])->whereHas('authors', function ($query) {
            $query->where('dblp_url', '=', Auth::user()->dblp_url);
        })->whereHas('groups', function ($query) use ($id) {
            $query->where('groups.id', '=', $id);
        });

        $authors = collect([]);
        $topics = collect([]);
        $singleType = collect([]);
        $singleTopic = collect([]);
        $singleYear = collect([]);

        if (!empty($publications)) {
            $publications->each(function ($item, $key) use ($authors, $topics, $singleTopic, $singleType, $singleYear) {
                $localAuthors = collect([]);
                $localAuthorsActive = collect([]);

                if ($item->authors->isNotEmpty()) {
                    $item->authors->map(function ($item, $key) use ($localAuthors, $localAuthorsActive) {
                        $localAuthors->push($item);
                        if ($item->user()->exists())
                            $localAuthorsActive->push(true);
                        else
                            $localAuthorsActive->push(false);
                    });
                    $authors->push(['authors' => $localAuthors, 'active' => $localAuthorsActive]);
                }

                $topics->push($item->topics);

                if (!$singleType->contains($item->type))
                    $singleType->push($item->type);
                $item->topics->map(function ($item, $key) use ($singleTopic) {
                    if (!$singleTopic->contains($item))
                        $singleTopic->push($item);
                });
                if (!$singleYear->contains($item->year))
                    $singleYear->push($item->year);
            });
        }

        $publications = $publications->paginate(10);

        $users = $group->users;
        $usersRole = collect([]);
        $role = null;
        $group->users->map(function ($item, $key) use (&$role, $usersRole) {
            if ($item->id === Auth::user()->id)
                $role = $item->pivot->role;
            $usersRole->push($item->pivot->role);
        });

        return view('groups.show', compact(
            'group',
            'users',
            'publications',
            'authors',
            'topics',
            'role',
            'singleType',
            'singleTopic',
            'singleYear',
            'usersRole'
        ));
    }

    public
    function destroy($id)
    {
        $group = Group::find($id);
        Storage::disk('public')->delete($group->image_url);
        $group->delete();
        return redirect()->back()->with('status', 'The group has been eliminated!');
    }

    public
    function acceptUser(Request $request)
    {
        $notification = GroupRegistrationNotification::find($request->get('notificationId'));
        $notification->delete();
        $group = Group::find($request->get('groupId'));
        $group->users()->attach($request->get('userId'), ['role' => 'user']);
        return redirect()->route('groups.show', $request->get('groupId'))->with('status', 'You joined the group');
    }

    public
    function getUserPublications($groupId)
    {
        $publications = \App\Publication::with(['authors', 'topics', 'groups'])
            ->whereHas('authors', function ($query) {
                $query->where('dblp_url', '=', Auth::user()->dblp_url);
            })->whereDoesntHave('groups', function ($query) use ($groupId) {
                $query->where('groups.id', '=', $groupId);
            })->orderBy('created_at' , 'desc')->paginate(10);

        $authors = collect([]);
        $topics = collect([]);

        if (!empty($publications)) {
            $publications->each(function ($item, $key) use ($authors, $topics) {
                $localAuthors = collect([]);
                $localAuthorsActive = collect([]);

                if ($item->authors->isNotEmpty()) {
                    $item->authors->map(function ($item, $key) use ($localAuthors, $localAuthorsActive) {
                        $localAuthors->push($item);
                        if ($item->user()->exists())
                            $localAuthorsActive->push(true);
                        else
                            $localAuthorsActive->push(false);
                    });
                    $authors->push(['authors' => $localAuthors, 'active' => $localAuthorsActive]);
                }
                $topics->push($item->topics);
            });
        }


        return view('groups.show_user_publications', compact(
            'publications',
            'authors',
            'topics',
            'groupId'
        ));
    }

    public
    function storeUserPublication(Request $request)
    {
        $group = Group::find($request->get('groupId'));
        $group->publications()->attach($request->get('publicationId'));
        return redirect()->back()->with('status', 'Publication has been added to selected group.');
    }

    public
    function storeAllUserPublications(Request $request)
    {
        $groupId = $request->get('groupId');
        $group = Group::find($groupId);
        $publications = \App\Publication::with(['authors', 'topics', 'groups'])
            ->whereHas('authors', function ($query) {
                $query->where('dblp_url', '=', Auth::user()->dblp_url);
            })->whereDoesntHave('groups', function ($query) use ($groupId) {
                $query->where('groups.id', '=', $groupId);
            })->get();
        $publicationsId = collect([]);
        if ($publications->isNotEmpty()) {
            $publications->map(function ($item, $key) use ($publicationsId) {
                $publicationsId->push($item->id);
            });
        }
        $group->publications()->attach($publicationsId);
        return redirect()->back()->with('status', 'Publication has been added to selected group.');
    }

    public
    function destroyUserPublication($groupId, $publicationId)
    {
        $group = Group::find($groupId);
        $group->publications()->detach($publicationId);
        return redirect()->back()->with('status', 'The publication has been removed from the group');
    }

    public function showAllUsers($groupId){
        $group = Group::with('users')->find($groupId);
        $users = $group->users;
        $usersRole = collect([]);
        $role = null;
        $group->users->map(function ($item, $key) use (&$role, $usersRole) {
            if ($item->id === Auth::user()->id)
                $role = $item->pivot->role;
            $usersRole->push($item->pivot->role);
        });
        return view('groups.manage_users' , compact(
            'groupId',
            'users',
            'usersRole'
        ));
    }

    public function updateUserRole(Request $request){
        $group = Group::find($request->get('groupId'));
        $group->users()->updateExistingPivot($request->get('userId') , ['role' => $request->get('role')]);
        return redirect()->back()->with('status' , 'User role has been updated!');
    }

    public function deleteUser(Request $request){
        $group = Group::find($request->get('groupId'));
        $group->users()->detach($request->get('userId'));
        return redirect()->back()->with('status' , 'The user has been deleted from the group!');
    }

    public function partecipate(Request $request){
        $group = Group::with('users')->find($request->get('groupId'));

        $group->users->map(function($item,$key) use($request){
           if($item->pivot->role === "super_administrator" or $item->pivot->role === "administrator")
               $item->notify(new GroupPartecipation($request->get('userId') , $request->get('groupId')));
        });
        return redirect()->back()->with('status', "Partecipation request has been sent to group staff!");
    }

    public function acceptPartecipation(Request $request){
        $group = Group::find($request->get('groupId'));
        $group->users()->attach($request->get('userId'), ['role' => 'user']);
        foreach(Auth::user()->notifications as $notification){
            if($notification->id === $request->get('notificationId'))
                $notification->delete();
        }
        return redirect()->back()->with('status', "User was added to the group!");
    }

    public function invitation(Request $request){
        $user = User::find($request->get('userId'));
        $user->notify(new GroupInvitation(Auth::user()->id , $request->get('groupId')));
        return redirect()->back()->with('status', "Request has been sent to the user!");
    }

    public function refuseInvitation(Request $request){
        //Eliminare dall'utente attuale
        $user = User::find($request->get('userId'));
        foreach($user->notifications as $notification){
            if($notification->id === $request->get('notificationId'))
                $notification->delete();
        }
        return redirect()->back()->with('status', "The invitation request has been rejected!");
    }

    public function refusePartecipation(Request $request){
        $group = Group::find($request->get('groupId'));
        $group->users->map(function ($item, $key) use($request){
            if($item->pivot->role === "super_administrator" or $item->pivot->role === "administrator"){
                foreach($item->notifications as $notification){
                    if($notification->id === $request->get('notificationId'))
                        $notification->delete();
                }
            }
        });
        return redirect()->back()->with('status', "The partecipation request has been rejected!");
    }



}
