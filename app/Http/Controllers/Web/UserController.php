<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use App\Services\Web\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store an instance of the UserService class.
     *
     * @var UserService
     */
    private $userService;

    /**
     * Create a new UserController instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display the information of the user.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, User $user)
    {
        if ($request->ajax()) {
            return $this->userService->selectView($request);
        }

        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Display the edit form the user.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the information about the user.
     *
     * @param UserRequest $request
     * @param ImageUploadHandler $uploader
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '個人資料更新成功');
    }
}
