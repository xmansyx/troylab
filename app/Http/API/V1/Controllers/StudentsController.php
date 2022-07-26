<?php

namespace App\Http\API\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**

    * return a listing of the resource.

    *

    * @return \Illuminate\Http\Response

    */

    public function index()

    {

        $students = Student::latest('order')->with('school')->paginate(20);

        return response()->json($students);

    }
    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $request->validate([

            'name' => 'required',
            'school_id' => 'required',

        ]);

        $latest_student_for_school = Student::where('school_id', $request->school_id)->latest()->first();

        Student::create([
            'name' => $request->name,
            'school_id' => $request->school_id,
            'order' => $latest_student_for_school?  $latest_student_for_school->order + 1 : 1
        ]);

        return response()->json(['sucess' => 'student created successfully']);

    }

     

    /**

     * Display the specified resource.

     *

     * @param  \App\Model\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function show(Student $student)

    {
        return response()->json($student);

    } 
    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Model\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Student $student)

    {

        $request->validate([

            'name' => 'required',
            'school_id' => 'required',

        ]);

        $student->update($request->all());

        return response()->json(['sucess' => 'student updated successfully']);

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Model\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function destroy(Student $student)

    {

        $student->delete();

        return response()->json(['sucess' => 'student deleted successfully']);

    }
}
