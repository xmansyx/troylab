@extends('layout')

 

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Admin panel: schools</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('schools.create') }}"> Add New Student</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

   

    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>School Name</th>


            <th width="280px">Action</th>

        </tr>

        @foreach ($schools as $school)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $school->name }}</td>


            <td>

                <form action="{{ route('schools.destroy',$school->id) }}" method="POST">

   

                    <a class="btn btn-info" href="{{ route('schools.show',$school->id) }}">Show</a>

    

                    <a class="btn btn-primary" href="{{ route('schools.edit',$school->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

  

    {!! $schools->links() !!}

      

@endsection