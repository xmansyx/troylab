<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $schools = School::latest()->paginate(20);

    

        return view('schools.index',compact('schools'))->with('i', (request()->input('page', 1) - 1) * 20);

    }

     

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('schools.create');

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

        ]);

        School::create($request->all());

        return redirect()->route('schools.index')->with('success','school created successfully.');

    }

     

    /**

     * Display the specified resource.

     *

     * @param  \App\Model\School  $school

     * @return \Illuminate\Http\Response

     */

    public function show(school $school)

    {

        return view('schools.show', compact('school'));

    } 

     

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Model\School  $school

     * @return \Illuminate\Http\Response

     */

    public function edit(school $school)

    {

        return view('schools.edit', compact('school'));

    }

    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Model\School  $school

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, school $school)

    {

        $request->validate([

            'name' => 'required',

        ]);

        $school->update($request->all());

        return redirect()->route('schools.index')->with('success','school updated successfully');

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Model\School  $school

     * @return \Illuminate\Http\Response

     */

    public function destroy(school $school)

    {

        $school->delete();

        return redirect()->route('schools.index')->with('success','school deleted successfully');

    }
}
