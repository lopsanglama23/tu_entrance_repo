<?php

namespace App\Http\Controllers;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\ManageRequest;
use App\Http\Requests\PersonalRequest;
use App\Models\Education;
use App\Models\Student;
use App\Models\Contact;
use App\Models\Manage;
use App\Models\User;
use App\Trait\DeleteTrait;
use App\Trait\ResponseTrait;
use App\Trait\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ManageResource;

class PersonalController extends BaseController
{
    use UploadTrait;
    use ResponseTrait;
    use DeleteTrait;
    public function personalDetails(PersonalRequest $request){
        $validated = $request->validated();
        $validated['date_of_birth_ad'] = date('Y-m-d', strtotime($validated['date_of_birth_ad']));
        if ($request->hasFile('student_photo')) {
            $validated['student_photo'] = $this->storeFile('students/photos',$request->file('student_photo'));
            // dd($validated['student_photo']);
        }
        if ($request->hasFile('student_signature')) {
            $validated['student_signature'] = $this->storeFile('students/signatures',$request->file('student_signature'));
            // dd($validated['student_signature']);
        }
        // $exists = User::where('id', Auth::id())->exists();
        // if ($exists) {
        //     return response()->json([
        //         'message' => 'You have already submitted the form.'
        //     ], 400);
        // }
        $validated['user_id'] = Auth::id();
        $students = Student::create($validated);
        return $this->sendSuccessMessage('The Student Data is Added Succesfully',$students);
    }

    public function contactDetail(Request $request){
        $valid = $request->validated();
        if ($request->hasFile('citizenship_copy')) {
            $valid['citizenship_copy'] = $this->storeFile('students/citizenship', $request->file('citizenship_copy'));
        }
        $valid['user_id'] = Auth::id();
        $contact = Contact::create($valid);
        return $this->sendSuccessMessage('The Contact Details are added Succcesfully', $contact);
    }
    public function education(EducationRequest $request){
        $valids = $request->validated();
        $valids['user_id'] = Auth::id();
        $education = Education::create($valids);
        return $this->sendSuccessMessage('Edcuation Details of user is added Suuceesfully', $education);       
    }

    public function manage(ManageRequest $request){
        $val = $request->validated();
        if ($request->hasFile('image')) {
            $val['image'] = $this->storeFile('students/documents', $request->file('image'));
        }
       
        $val['user_id'] = Auth::id();
        $manage = Manage::create($val);
       
        return $this->sendSuccessMessage('The Documents are added succesfully',
        new ManageResource($manage),
        );
    } 
    public function deleteManage(Request $request, $title){
        return $this->deletion($request, $title);
    }
    public function educationPreview(Request $request, $id){

        $preview  = Education::select(
            'your_degree',
            'board_name',
            'major_subject',
            'academic_year',
            'division_grade',
            'complete_years'
        )->find($id);     
        if(!$preview){
            return response()->json([
                'message' => 'Education details not found',
                'data' => $preview,
            ],404);
        }
        return response()->json([
            'data' => $preview,
        ],200);
    }
     public function edudelete(Request $request, $id){
        $edu  = Education::where('id',$id)->delete();
        // $edu  = Education::destroy($id);
        return response()->json([
            'message' => 'The education details deleted',
        ]);
     }
    // Educational details Preview include Education and Manage model
     public function getpreview(Request $request, $user_id){

        $educations = Education::where('user_id', $user_id)->get();
        $manages = Manage::where('user_id', $user_id)->get();

        return response()->json([
            'message' => 'Preview of student educational and management details',
            'data' => [
                'educations' => $educations,
                'manages' => $manages,
            ],
        ]);
    }
    // Image Url Preview page student image and signature of single student
    public function url(Request $request, $id){
        $student_images = Student::find($id);
        return new StudentResource($student_images);
    }
    //Image Url preview page student image and signature of whole student
    public function urls(Request $request){
        $student_images = Student::all();
        // return new StudentResource($student_images);
        return StudentResource::collection($student_images);
    }

    public function manageurl(Request $request){
        $manages = Manage::all();
        return ManageResource::collection($manages);
    }
//All details Peview Page of Student
    public function preview(Request $request, $user_id){
        $stu = Student::select([
            'first_name',
            'middle_name',
            'last_name',
            'first_name_dev',
            'middle_name_dev',
            'last_name_dev',
            'gender',
            'marital_status',
            'date_of_birth_bs',
            'date_of_birth_ad',
            'father_name',
            'mother_name',
            'student_photo',
            'student_signature'
        ])->where('user_id',$user_id)->first(); 
        if($stu){        
            $stu->full_name = trim("{$stu->first_name} {$stu->middle_name} {$stu->last_name}");
        }
        if($stu){                  
            $stu->full_name_dev = trim("{$stu->first_name_dev} {$stu->middle_name_dev} {$stu->last_name_dev}");
        }
        $edu = Education::select([
            'your_degree',
            'board_name',
            'major_subject',
            'academic_year',
            'division_grade',
            'complete_years'
        ])->where('user_id',$user_id)->first();
        $con = Contact::select([
            'citizenship_no',
            'district',
            'permanent_address',
            'contact_landline',
            'contact_phone',
        ])->where('user_id',$user_id)->first();
        $man = Manage::select([
            'title',
            'image'
        ])->where('user_id',$user_id)->first();
        return $this->sendSuccessMessages('The preview Page fo Student Details..!',$stu,$edu,$con,$man);
    }
 
}