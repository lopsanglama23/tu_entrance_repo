<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\SubjectRequest;
use App\Models\Admin\Subject;
use Illuminate\Http\Request;

class SubjectController extends BaseController
{
    public function addSubjects(SubjectRequest $request){
        $sub = $request->validated();
        if(is_array($sub) && isset($sub[0])) {
            $timestamp = now();
            foreach ($sub as &$s) {
                $s['created_at'] = $timestamp;
                $s['updated_at'] = $timestamp;
            }
            Subject::insert($sub);
        } else {
            Subject::create($sub);
        }
        return $this->sendSuccessMessage('The subjects are added successfully', $sub);
    }
}
