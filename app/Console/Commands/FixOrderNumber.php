<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FixOrderNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reorder students if any student deleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $deleted_students = Student::onlyTrashed()->oldest()->get();

        // foreach($deleted_students as $deleted_student){
        //     DB::table('students')
        //         ->where('school_id', $deleted_student->school_id)
        //         ->where('id', '>', $deleted_student->id)
        //         ->where('order', '>', $deleted_student->order)
        //         ->oldest()
        //         ->decrement('order');
        // }

        $schools = School::with('students')->oldest()->get();
        foreach($schools as $school){
            
            foreach($school->students as $key => $student){
               $student->update(['order' => ++$key]);
               $student->save();
            }
        }

        $this->info('data reorder complete');
        $this->info('sending email...');

        Mail::send('mail.command-done',[], function($message) {
            $message->to('xmasyx@gmail.com', 'Mustafa Mansy')->subject('data reordered successfully');
            $message->from('xmasyx@gmail.com','Mustafa Mansy');
         });

        $this->info('email sent succeffully');
    }
}
