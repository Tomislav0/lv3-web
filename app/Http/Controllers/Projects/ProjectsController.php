<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Project_user;
use App\Models\User;
use App\Http\Controllers\Controller;
use Auth;

class ProjectsController extends Controller
{
    // app/Http/Controllers/ProjectController.php

    public function create()
    {
        $users = User::whereNotIn('id', [Auth::id()])->get();
        $project = [
            'name' => '',
            'description' => '',
            'price' => '',
            'is_done' => '',
            'user_ids' => ''
        ];
        return view('components.project', ['users' => $users, 'is_leader' => true, 'project' => $project]);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => '',
            'price' => '',
            'is_done' => '',
            'users' => ''
        ]);
        if ($request->id) {
            $project = Projects::find($request->id);
        } else {
            $project = new Projects();
        }
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->price = $validatedData['price'];
        $project->jobs_done = $request->has('is_done');
        $project->started = date("Y-m-d");
        $project->leader = Auth::id();
        $project->timestamps = false;
        if ($project->id) {
            $project->id = $request->id;
            $project->update();
        } else {
            Project_user::where('project', $request->id)->delete();

            $project->update();
        }

        if (!empty ($request->user_ids)) {
            foreach ($request->user_ids as $user_id) {
                $project_user = new Project_user();
                $project_user->user = $user_id;
                $project_user->project = $project->id;
                $project_user->timestamps = false;
                $project_user->save();
            }
        }


        return redirect()->route('home');
    }

    public function index()
    {
        $my_projects = Projects::where('leader', Auth::id())->get();

        $foreign_projects_ids = Project_user::where('user', Auth::id())->get('project');

        $foreign_projects = Projects::whereIn('id', $foreign_projects_ids)->get();

        return view('profile', ['my_projects' => $my_projects, 'foreign_projects' => $foreign_projects]);
    }

    public function edit($id)
    {
        $project = Projects::find($id);
        $is_leader = $project->leader === Auth::id();

        $included_users = Project_user::where('project', [$id])->get('user');
        $project_parsed = [
            'id' => $id,
            'name' => $project->name,
            'description' => $project->description,
            'price' => $project->price,
            'is_done' => $project->jobs_done ? true : false,
            'user_ids' => $included_users
        ];

        $users = User::whereNotIn('id', [Auth::id()])->get();
        return view('components.project', ['users' => $users, 'is_leader' => $is_leader, 'project' => $project_parsed]);
    }

}
