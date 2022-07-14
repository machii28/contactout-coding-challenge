<?php

namespace App\Http\Requests;

use App\Rules\ExistingEmails;
use App\Rules\MaxReferrals;
use App\Rules\UninvitedEmails;
use Illuminate\Foundation\Http\FormRequest;

class CreateReferralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'emails' => [
                'required',
                'array',
                new ExistingEmails,
                new UninvitedEmails,
                new MaxReferrals
            ]
        ];
    }
}
