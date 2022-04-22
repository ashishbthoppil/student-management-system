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
        @if(Route::current()->getName() == 'edit.student' && isset($studentData['name']))
          <p>Edit student - {{ $studentData['name'] }}</p>
        @else
          <p>Add students</p>
        @endif
            
        </h1>
      </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 m-auto">
        @if(Route::current()->getName() == 'edit.student')
        <form class="student_form" method="POST" action="{{ route('update.student', ['id' => $studentData['id']]) }}">
        @else
        <form class="student_form" method="POST" action="{{ route('save.student') }}">
        @endif
          @csrf
          <div class="row">
              <div class="col-md-12">
                <label for="student_name" class="col-form-label">Student Name:</label>
                @if(isset($studentData['name']))
                  <input type="text" class="form-control" id="student_name" name="student_name" value="{{ $studentData['name'] }}">
                @else
                  <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}">
                @endif
                
                @if ($errors->has('student_name'))
                    <span class="text-danger">{{ $errors->first('student_name') }}</span>
                @endif
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <label for="age" class="col-form-label">Age:</label>
                @if(isset($studentData['age']))
                 <input type="number" class="form-control" id="age" name="age" value="{{ $studentData['age'] }}">
                @else
                 <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}">
                @endif
                
                @if ($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
              </div>
              <div class="col-md-6">
              <div class="mb-3">
                <label for="gender" class="col-form-label">Gender:</label>
                <div class="radio_group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="M" {{isset($studentData['gender']) ? $studentData['gender'] == "M" ? "checked" : "" : "checked" }}>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check female_radio">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="F" {{isset($studentData['gender']) ? $studentData['gender'] == "F" ? "checked" : "" : "" }}>
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-12">
                <label for="reporting_teacher" class="col-form-label">Reporting Teacher:</label>
                <select class="form-select" id="reporting_teacher" name="reporting_teacher" placeholder="Please select the reporting teacher" value="{{ old('reporting_teacher') }}">
                @if(Route::current()->getName() == 'edit.student' && isset($studentData['name']))
                    <option disabled value="">Please select the reporting teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ isset($studentData['teacher']) && $studentData['teacher'] == $teacher->id ? "selected" : "" }}>{{ $teacher->name }}</option>
                    @endforeach
                @else
                    <option disabled selected value="">Please select the reporting teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                @endif
                    
                </select>
                @if ($errors->has('reporting_teacher'))
                    <span class="text-danger">{{ $errors->first('reporting_teacher') }}</span>
                @endif
              </div>
          </div>
          @if(Route::current()->getName() == 'edit.student')
            <button type="submit" class="btn btn-success mt-5">Update</button>
          @else
            <button type="submit" class="btn btn-success mt-5">Save</button>
          @endif
        </form>
        </div>
    </div>
  </div>
</section>
@endsection('content')