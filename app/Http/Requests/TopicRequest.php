<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TopicRequest extends FormRequest
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
      // 保存修改文章验证
      switch($this->method())
      {
          // CREATE
          case 'POST':
          // UPDATE
          case 'PUT':
          case 'PATCH':
          {
              return [
                  'name'       => 'required|min:2',
                  'body'        => 'required|min:3',
                  'work_id' => 'required|numeric',
                  'user_id' => 'required|numeric',
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
