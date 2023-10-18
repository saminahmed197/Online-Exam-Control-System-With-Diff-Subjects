<?php

namespace App\Http\Controllers;


use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;

class AdminController extends Controller
{
    // add subject
    public function addSubject(Request $request)
    {
        try{
            Subject::insert(['subject' => $request->subject]);
            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Subject added Successfully'
                ]
                );

        }catch(\Exception $e){
            return response()->json(
                [
                    'success' => false,
                    'msg' => $e->getMessage()
                ]
                );
        };
       
    }

    // edit subject
    public function editSubject(Request $request)
    {
        try{
            $subject = Subject::find( $request->id);
            $subject->subject = $request->subject;
            $subject->save();
            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Subject updated Successfully'
                ]
                );

        }catch(\Exception $e){
            return response()->json(
                [
                    'success' => false,
                    'msg' => $e->getMessage()
                ]
                );
        };
       
    }

    // delete subject
    public function deleteSubject(Request $request)
    {
        try{
            Subject::where('id', $request->id)->delete();
            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Subject deleted Successfully'
                ]
                );

        }catch(\Exception $e){
            return response()->json(
                [
                    'success' => false,
                    'msg' => $e->getMessage()
                ]
                );
        };
       
    }

    // exam dashboard load

    public function examDashboard(){
        $subjects = Subject::all();
        return view('admin.exam-dashboard', ['subjects' =>$subjects]);
    }
}
