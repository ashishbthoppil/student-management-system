@extends('Layouts.app')
@section('content')
<section id="intro_section">
  <div class="container">
    <div class="row align-items-center pb-5 mt-5">
      <div class="col-md-6 intros text-start">
            <h1>
                Add terms
            </h1>
       </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6 m-auto">
            <form method="post" action="{{ route('save.terms') }}">
                @csrf
                <div>
                    <label for="reporting_teacher" class="col-form-label">Number of terms</label>
                    <input type="number" max="10" min="0" name="terms" id="terms" class="form-control" value="{{ $term->termname }}">
                    @if ($errors->has('terms'))
                        <span class="text-danger">{{ $errors->first('terms') }}</span>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-success mt-4">Save</button>
            </form>
       </div>
    </div>
  </div>
</section>
@endsection('content')