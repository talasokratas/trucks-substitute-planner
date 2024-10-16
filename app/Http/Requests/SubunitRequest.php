<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;

class SubunitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'main_truck' => 'required|exists:trucks,id',
            'subunit' => 'required|exists:trucks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

    public function validateRequest()
    {
        $this->validateOverlap();
        $this->validateMainTruckAvailable();
    }

    private function validateOverlap()
    {
        $overlapping = DB::table('truck_subunits')
            ->where('subunit', $this->subunit) // Check for overlaps specifically for the selected subunit
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date]);
            })
            ->exists();

        if ($overlapping) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors' => 'Date range overlaps with an existing subunit assignment.',
            ], 422));
        }
    }

    private function validateMainTruckAvailable()
    {
        $activeAssignments = DB::table('truck_subunits')
            ->where('main_truck', $this->main_truck)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date]);
            })
            ->exists();

        if ($activeAssignments) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors' => [
                    'main_truck_active' => 'The selected truck cannot be assigned as a subunit.'
                ]
            ], 422));
        }
    }
}
