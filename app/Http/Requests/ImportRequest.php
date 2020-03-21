<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*return [
            'file' => 'required|mimes:xlsx',
        ];*/

        /*return [
            'file'          => 'required',
            'extension'     => 'required|in:xlsx',
        ];*/

        /*$extensions = array("xls","xlsx","xlm","xla","xlc","xlt","xlw");

        $result = array($request->file('import_file')->getClientOriginalExtension());

        if(in_array($result[0],$extensions)){
            // Do something when Succeeded
        }else{
            // Do something when it fails
        }*/
    }
}
