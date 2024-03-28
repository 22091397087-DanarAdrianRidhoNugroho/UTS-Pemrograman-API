<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(AddressRequest $request, $idContact)
    {
        $contact = Contact::find($idContact);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Contact not found'
                ]
            ], 404);
        }

        $data = $request->validated();
        $address = new Address($data);
        $address->contact_id = $contact->id;
        $address->save();

        return (new AddressResource($address))->response()->setStatusCode(201);
    }

    public function index($idContact)
    {
        $contact = Contact::find($idContact);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Contact not found'
                ]
            ], 404);
        }

        $addresses = $contact->addresses;

        return response()->json([
            'data' => AddressResource::collection($addresses),
            'errors' => (object)[]
        ]);
    }

    public function show($idContact, $idAddress)
    {
        $contact = Contact::find($idContact);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Contact not found'
                ]
            ], 404);
        }

        $address = $contact->addresses()->find($idAddress);

        if (!$address) {
            return response()->json([
                'errors' => [
                    'message' => 'Address not found'
                ]
            ], 404);
        }

        return response()->json([
            'data' => new AddressResource($address),
            'errors' => (object)[]
        ]);
    }

    public function update(AddressRequest $request, $idContact, $idAddress)
    {
        $contact = Contact::find($idContact);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Contact not found'
                ]
            ], 404);
        }

        $address = $contact->addresses()->find($idAddress);

        if (!$address) {
            return response()->json([
                'errors' => [
                    'message' => 'Address not found'
                ]
            ], 404);
        }

        $data = $request->validated();
        $address->update($data);

        return response()->json([
            'data' => new AddressResource($address),
            'errors' => (object)[]
        ]);
    }

    public function destroy($idContact, $idAddress)
    {
        $contact = Contact::find($idContact);

        if (!$contact) {
            return response()->json([
                'errors' => [
                    'message' => 'Contact not found'
                ]
            ], 404);
        }

        $address = $contact->addresses()->find($idAddress);

        if (!$address) {
            return response()->json([
                'errors' => [
                    'message' => 'Address not found'
                ]
            ], 404);
        }

        $address->delete();

        return response()->json([
            'data' => true,
            'errors' => (object)[]
        ]);
    }
}
