@extends('Layouts.app')
@section('content')
<style>
a.btn.btn-danger.mark_delete {
    position: relative;
    left: 15px;
}

</style>
<section id="intro_section">
  <div class="container">
    <div class="row align-items-center pb-5 mt-5">
      <div class="col-md-6 intros text-start">
        <h1>
            <p>Mark List</p>
        </h1>
      </div>
    </div>
    <div class="row align-items-center pb-5 mt-5">
        <table class="table table-striped mark_list">
            <thead class="table-dark">
                <tr>
                    <th class="text-right">ID</th>
                    <th class="text-right">Name</th>
                    <th class="text-right">Maths</th>
                    <th class="text-right">Science</th>
                    <th class="text-right">History</th>
                    <th class="text-center">Term</th>
                    <th class="text-center">Total Marks</th>
                    <th class="text-center">Created On</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($markData as $mark)
                <tr>
                    <td class="text-right">{{ $mark['id'] }}</td>
                    <td class="text-right">{{ $mark['name'] }}</td>
                    <td class="text-right">{{ $mark['math'] }}</td>
                    <td class="text-right">{{ $mark['science'] }}</td>
                    <td class="text-right">{{ $mark['history'] }}</td>
                    <td class="text-right">{{ $mark['term'] }}</td>
                    <td class="text-right">{{ $mark['total_marks'] }}</td>
                    <td class="text-right">{{ $mark['created_on'] }}</td>
                    <td class="text-center"><a href="{{ route('edit.marks', ['id' => $mark['id']]) }}" class="btn btn-primary" id="{{ $mark['id'] }}">Edit</a><a href="{{ route('delete.marks', ['id' => $mark['id']]) }}" class="btn btn-danger mark_delete" id="{{ $mark['id'] }}">Delete</a></td>
                </tr>  
              @endforeach 
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection('content')