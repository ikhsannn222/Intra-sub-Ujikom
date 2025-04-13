<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::with(['owner', 'status', 'tasks'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Project',
            'projects' => $projects,
        ], 200);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'ticket_prefix' => 'required|string|max:10',
            'cover_image' => 'nullable|string',
        ]);

        $project = Project::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dibuat',
            'project' => $project,
        ], 201);
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        $project = Project::with(['owner', 'status', 'tasks'])->find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Project',
            'project' => $project,
        ], 200);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan',
            ], 404);
        }

        $project->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil diperbarui',
            'project' => $project,
        ], 200);
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan',
            ], 404);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus',
        ], 200);
    }
}
