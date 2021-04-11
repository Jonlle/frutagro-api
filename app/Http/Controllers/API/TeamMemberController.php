<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Requests\TeamMemberRequest;
use App\Http\Resources\TeamMemberCollection;
use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMembers = TeamMember::all();
        $teamMembers = new TeamMemberCollection($teamMembers);

        return $this->sendResponse(trans('response.success_team_member_index'), $teamMembers);
    }

    /**
     * @param \App\Http\Requests\TeamMemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamMemberRequest $request)
    {
        TeamMember::create($request->validated());

        return $this->sendResponse(trans('response.success_team_member_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * @param \App\Models\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        $teamMember = new TeamMemberResource($teamMember);

        return $this->sendResponse(trans('response.success_team_member_show'), $teamMember);
    }

    /**
     * @param \App\Http\Requests\TeamMemberRequest $request
     * @param \App\Models\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(TeamMemberRequest $request, TeamMember $teamMember)
    {
        $teamMember->update($request->validated());

        return $this->sendResponse(trans('response.success_team_member_update'));
    }

    /**
     * @param \App\Models\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return $this->sendResponse(trans('response.success_team_member_destroy'));
    }
}
