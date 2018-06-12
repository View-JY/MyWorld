<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
      // 保存修改分类验证
      switch($this->method())
      {
          // CREATE
          case 'POST':
          // UPDATE
          case 'PUT':
          case 'PATCH':
          {
              return [
                  'name'       => 'required|min:1',
                  'description'        => 'required|min:2',
              ];
          }
          case 'GET':
          case 'DELETE':
          default:
          {
              return [];
          };
      }
    }
}
