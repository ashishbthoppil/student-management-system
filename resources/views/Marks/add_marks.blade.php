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
        @if(Route::current()->getName() == 'edit.marks' && isset($markData['name']))
          <p>Edit marks - {{ $markData['name'] }}</p>
        @else
          <p>Add marks</p>
        @endif
            
        </h1>
      </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 m-auto">
        @if(Route::current()->getName() == 'edit.marks')
        <form class="marks_form" method="POST" action="{{ route('update.marks', ['id' => $markData['id']]) }}">
        @else
        <form class="marks_form" method="POST" action="{{ route('save.marks') }}">
        @endif
          @csrf
          <div class="row">
              <div class="col-md-12">
                <label for="student" class="col-form-label">Student:</label>
                <select class="form-select" id="student" name="student" placeholder="Please select the student" value="{{ old('student') }}">
                    @if(Route::current()->getName() == 'edit.marks' && isset($markData['student']))
                        <option disabled value="">Please select the student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ isset($markData['student']) && $markData['student'] == $student->id ? "selected" : "" }}>{{ $student->name }}</option>
                        @endforeach
                    @else
                        <option disabled selected value="">Please select the student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('student'))
                    <span class="text-danger">{{ $errors->first('student') }}</span>
                @endif
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                <label for="math" class="col-form-label">Marks in Maths:</label>
                @if(isset($markData['math']))
                 <input type="number" class="form-control" id="math" name="math" value="{{ $markData['math'] }}" min="0" max="100">
                @else
                 <input type="number" class="form-control" id="math" name="math" value="{{ old('math') }}">
                @endif
                
                @if ($errors->has('math'))
                    <span class="text-danger">{{ $errors->first('math') }}</span>
                @endif
              </div>

              <div class="col-md-4">
                <label for="science" class="col-form-label">Marks in Science:</label>
                @if(isset($markData['science']))
                 <input type="number" class="form-control" id="science" name="science" value="{{ $markData['science'] }}">
                @else
                 <input type="number" class="form-control" id="science" name="science" value="{{ old('science') }}">
                @endif
                
                @if ($errors->has('science'))
                    <span class="text-danger">{{ $errors->first('science') }}</span>
                @endif
              </div>

              <div class="col-md-4">
                <label for="history" class="col-form-label">Marks in History:</label>
                @if(isset($markData['history']))
                 <input type="number" class="form-control" id="history" name="history" value="{{ $markData['history'] }}">
                @else
                 <input type="number" class="form-control" id="history" name="history" value="{{ old('history') }}">
                @endif
                @if ($errors->has('history'))
                    <span class="text-danger">{{ $errors->first('history') }}</span>
                @endif
              </div>
          </div>

          <div class="row">
              <div class="col-md-12">
                <label for="term" class="col-form-label">Term:</label>
                <select class="form-select" id="term" name="term" placeholder="Please select the term" value="{{ old('term') }}">
                    @php 
                        $termArray = config('global.terms');
                    @endphp
                    @if(Route::current()->getName() == 'edit.marks' && isset($markData['term']))
                        <option disabled value="">Please select the term</option>
                        @for($i=1;$i<=intval($terms->termname);$i++)
                            <option value="{{ $termArray[strval($i)] }}" {{ isset($markData['term']) && $markData['term'] == $termArray[strval($i)] ? "selected" : "" }}>{{ $termArray[strval($i)] }}</option>
                        @endfor
                    @else
                        <option disabled selected value="">Please select the terms</option>
                        @for($i=1;$i<=intval($terms->termname);$i++)
                            <option value="{{ $termArray[strval($i)] }}">{{ $termArray[strval($i)] }}</option>
                        @endfor
                    @endif
                </select>
                @if ($errors->has('term'))
                    <span class="text-danger">{{ $errors->first('term') }}</span>
                @endif
              </div>
          </div>
          @if(Route::current()->getName() == 'edit.marks')
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