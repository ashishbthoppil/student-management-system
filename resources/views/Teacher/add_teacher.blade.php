@extends('Layouts.app')
@section('content')
<style>
.radio_group {
    display: flex;
}
.female_radio {
    position: relative;
    left: 10px;
}
</style>
<section id="intro_section">
  <div class="container">
    <div class="row align-items-center pb-5 mt-5">
      <div class="col-md-6 intros text-start">
        <h1>
            <p>Add Teachers</p>
        </h1>
      </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 m-auto">
        <form class="teacher_form" method="POST" action="{{ route('save.teacher') }}">
          @csrf
          <div class="row">
              <div class="col-md-12">
                <label for="teacher_name" class="col-form-label">Teacher Name:</label>
                <input type="text" class="form-control" id="teacher_name" name="teacher_name">
                @if ($errors->has('teacher_name'))
                    <span class="text-danger">{{ $errors->first('teacher_name') }}</span>
                @endif
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <label for="age" class="col-form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age">
                @if ($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
              </div>
              <div class="col-md-6">
              <div class="mb-3">
                <label for="gender" class="col-form-label">Gender:</label>
                <div class="radio_group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="M" checked>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check female_radio">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success mt-5">Save</button>
        </form>
        </div>
    </div>
    <hr class="mt-5 mb-5">
    <div class="row">
      <h1>Teachers list</h1>
    </div>
    <div class="row align-items-center pb-5 mt-5">
        <table class="table table-striped student_list">
            <thead class="table-dark">
                <tr>
                    <th class="text-right">ID</th>
                    <th class="text-right">Name</th>
                    <th class="text-right">Age</th>
                    <th class="text-right">Gender</th>
                </tr>
            </thead>
            <tbody>
              @if(count($teachers))
                @foreach($teachers as $teacher)
                  <tr>
                      <td class="text-right">{{ $teacher->id }}</td>
                      <td class="text-right">{{ $teacher->name }}</td>
                      <td class="text-right">{{ $teacher->age }}</td>
                      <td class="text-right">{{ $teacher->gender }}</td>
                  </tr>  
                @endforeach 
              @else
                  <tr>
                    <td colspan="4" class="text-center"><h4>No data to display</h4></td>
                  </tr>
              @endif
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection('content')
