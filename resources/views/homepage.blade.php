@extends('Layouts.app')
@section('content')
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
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Reporting Teacher</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($studentDatas as $student)
                <tr>
                    <td>{{ $student['id'] }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['age'] }}</td>
                    <td>{{ $student['gender'] }}</td>
                    <td>{{ $student['reporting_teacher'] }}</td>
                    <td>Edit/Delete</td>
                </tr>  
              @endforeach 
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection('content')

