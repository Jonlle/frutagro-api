<?php

namespace App\Http\Controllers\API;

use App\User;
use App\UserEmail;
use App\UserPhone;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\Customer as CustomerResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Validator;
use Illuminate\Support\Facades\Log;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new CustomerCollection(
            User::whereIn('role_id', ['person', 'business'])
                ->get()
        );

        return $this->sendResponse($users, 'Users has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomer  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $validated = $request->validated();

        $user_email = new UserEmail([
            'email' => $request['email'],
            'status_id' => 'ac',
            'principal' => '1'
        ]);

        $data = Arr::except($validated, ['email']);
        $data['password'] = Hash::make($data['password']);

        $user = new User($data);
        $user->save();
        $user->user_emails()->save($user_email);

        return $this->sendResponse([], 'User has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id != 'person' && $user->role_id != 'business') {
            return $this->sendError('User is not a customer.', []);
        }

        $user = new CustomerResource($user);

        return $this->sendResponse($user, 'User has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomer  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id != 'person' && $user->role_id != 'business') {
            return $this->sendError('User is not a customer.', []);
        }

        $validated = $request->validated();
        Log::debug('request: ' . json_encode($validated));

        $user_emails = $user->user_emails;
        $user_phones = $user->user_phones;
        Log::debug('user_emails: ' . json_encode($user_emails));
        Log::debug('user_phones: ' . json_encode($user_phones));

        $email = isset($validated['email']) ? $validated['email'] : null;
        $alternate_email = isset($validated['alternate_email']) ? $validated['alternate_email'] : null;
        $phone = isset($validated['phone']) ? $validated['phone'] : null;
        $alternate_phone = isset($validated['alternate_phone']) ? $validated['alternate_phone'] : null;

        unset($validated['email']);
        unset($validated['alternate_email']);
        unset($validated['phone']);
        unset($validated['alternate_phone']);

        Log::debug('user update: ' . json_encode($validated));
        // return $this->sendResponse([], 'Probando...');

        // Actualización de email principal
        $ppal_email = $user_emails[0]->email;

        if ($email) {
            if ($ppal_email != $email) {
                $user_emails[0]->email = $email;
                $user_emails[0]->save();
            }
        }

        // Actualización de email alternativo
        // $alternate_email = !empty($validated['alternate_email']) ? Arr::pull($validated, 'alternate_email') : null;

        if (isset($user_emails[1])) {
            $sec_email = $user_emails[1]->email;

            if ($alternate_email) {
                if ($sec_email != $alternate_email) {
                    $user_emails[1]->email = $alternate_email;
                    $user_emails[1]->status_id = 'ac';
                    $user_emails[1]->save();
                } elseif ($user_emails[1]->status_id == 'in') {
                    $user_emails[1]->status_id = 'ac';
                    $user_emails[1]->save();
                }
            } else {
                if ($user_emails[1]->status_id != 'in') {
                    $user_emails[1]->status_id = 'in';
                    $user_emails[1]->save();
                }
            }
        } else {
            if ($alternate_email) {
                $user_email = new UserEmail([
                    'email' => $alternate_email,
                    'status_id' => 'ac',
                    'principal' => '0'
                ]);

                $user->user_emails()->save($user_email);
            }
        }

        // Actualización de teléfono
        // $phone = !empty($validated['phone']) ? Arr::pull($validated, 'phone') : null;

        if (isset($user_phones[0])) {
            $ppal_phone = $user_phones[0]->phone_number;

            if ($phone) {
                if ($ppal_phone != $phone) {
                    $user_phones[0]->phone_number = $phone;
                    $user_phones[0]->status_id = 'ac';
                    $user_phones[0]->save();
                } elseif ($user_phones[0]->status_id == 'in') {
                    $user_phones[0]->status_id = 'ac';
                    $user_phones[0]->save();
                }
            }
            // else {
            //     if ($user_phones[0]->status_id != 'in') {
            //         $user_phones[0]->status_id = 'in';
            //         $user_phones[0]->save();
            //     }
            // }
        } else {
            if ($phone) {
                $user_phone = new UserPhone([
                    'phone_number' => $phone,
                    'status_id' => 'ac',
                    'principal' => '1'
                ]);

                $user->user_phones()->save($user_phone);
            }
        }

        // Actualización de teléfono alternativo
        // $alternate_phone = !empty($validated['alternate_phone']) ? Arr::pull($validated, 'alternate_phone') : null;

        if (isset($user_phones[1])) {
            $sec_phone = $user_phones[1]->phone_number;

            if ($alternate_phone) {
                if ($sec_phone != $alternate_phone) {
                    $user_phones[1]->phone_number = $alternate_phone;
                    $user_phones[1]->status_id = 'ac';
                    $user_phones[1]->save();
                } elseif ($user_phones[1]->status_id == 'in') {
                    $user_phones[1]->status_id = 'ac';
                    $user_phones[1]->save();
                }
            } else {
                if ($user_phones[1]->status_id != 'in') {
                    $user_phones[1]->status_id = 'in';
                    $user_phones[1]->save();
                }
            }
        } else {
            if ($alternate_phone) {
                $user_phone = new UserPhone([
                    'phone_number' => $alternate_phone,
                    'status_id' => 'ac',
                    'principal' => '0'
                ]);

                $user->user_phones()->save($user_phone);
            }
        }

        foreach ($validated as $key => $value) {
            $user[$key] = $value;
        }

        $user->save();

        return $this->sendResponse([], 'User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->sendResponse([], 'User has been deleted successfully.');
    }
}
