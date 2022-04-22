@extends('Layouts.app')
@section('content')
<style>
a.btn.btn-danger.student_delete {
    position: relative;
    left: 15px;
}

</style>
<section id="intro_section">
  <div class="container">
    <div class="row align-items-center pb-5 mt-5">
      <div class="col-md-6 intros text-start">
        <h1>
            <p>Student's List</p>
        </h1>
      </div>
    </div>
    <div class="row align-items-center pb-5 mt-5">
        <table class="table table-striped student_list">
            <thead class="table-dark">
                <tr>
                    <th class="text-right">ID</th>
                    <th class="text-right">Name</th>
                    <th class="text-right">Age</th>
                    <th class="text-right">Gender</th>
                    <th class="text-right">Reporting Teacher</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($studentDatas as $student)
                <tr>
                    <td class="text-right">{{ $student['id'] }}</td>
                    <td class="text-right">{{ $student['name'] }}</td>
                    <td class="text-right">{{ $student['age'] }}</td>
                    <td class="text-right">{{ $student['gender'] }}</td>
                    <td class="text-right">{{ $student['reporting_teacher'] }}</td>
                    <td class="text-center"><a href="{{ route('edit.student', ['id' => $student['id']]) }}" class="btn btn-primary" id="{{ $student['id'] }}">Edit</a><a href="{{ route('delete.student', ['id' => $student['id']]) }}" class="btn btn-danger student_delete" id="{{ $student['id'] }}">Delete</a></td>
                </tr>  
              @endforeach 
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection('content')

