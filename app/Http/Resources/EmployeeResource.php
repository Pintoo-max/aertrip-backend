<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => trim($this->first_name.' '.$this->last_name),
            'email' => $this->email,

            'department' => [
                'id'   => $this->department?->id,
                'name' => $this->department?->name,
            ],

            'contacts' => $this->contacts->map(function ($contact) {
                return [
                    'id'           => $contact->id,
                    'phone_number' => $contact->phone_number,
                    'type'         => $contact->type,
                ];
            }),

            'addresses' => $this->addresses->map(function ($address) {
                return [
                    'id'            => $address->id,
                    'address_line1' => $address->address_line1,
                    'city'          => $address->city,
                    'state'         => $address->state,
                    'pincode'       => $address->pincode,
                    'country'       => $address->country,
                ];
            }),

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
