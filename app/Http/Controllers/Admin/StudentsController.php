<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**

    * Display a listing of the resource.

    *

    * @return \Illuminate\Http\Response

    */

    public function index()

    {

        $students = Student::latest('order')->with('school')->paginate(10);

        return view('students.index', compact('students'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

     

    /**

    * Show the form for creating a new resource.

    *

    * @return \Illuminate\Http\Response

    */

    public function create()

    {
        $schools = School::latest()->get();
        return view('students.create', compact('schools'));

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

        return redirect()->route('students.index')->with('success','student created successfully.');

    }

     

    /**

     * Display the specified resource.

     *

     * @param  \App\Model\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function show(Student $student)

    {
        return view('students.show',compact('student'));

    } 

     

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Model\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function edit(student $student)

    {
        $schools = School::latest()->get();
        return view('students.edit',compact('student'))->with('schools', $schools);

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

        return redirect()->route('students.index')->with('success','student updated successfully');

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

        return redirect()->route('students.index')->with('success','student deleted successfully');

    }
}
