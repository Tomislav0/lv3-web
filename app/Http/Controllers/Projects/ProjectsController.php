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
        return view('components.project', ['users' => $users]);
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

        $project = new Projects();
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->price = $validatedData['price'];
        $project->jobs_done = $request->has('is_done');
        $project->started = date("Y-m-d");
        $project->leader = Auth::id();
        $project->timestamps = false;
        $project->save();

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

}
