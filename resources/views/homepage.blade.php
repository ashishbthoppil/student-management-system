@extends('Layouts.app')
@section('content')
<style>

</style>
<section id="intro_section">
  <div class="container">
    <div class="row align-items-center pb-5 mt-5">
      <div class="col-md-6 intros text-start">
        <h1>
            <p>Welcome to</p>
            <p>Student Management System</p>
        </h1>
      </div>
    </div>
    <div class="row align-items-center pb-5 mt-5">
        <table class="table table-striped">
            <thead class="table-dark">
                <th>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Age</td>
                    <td>Gender</td>
                    <td>Reporting Teacher</td>
                    <td>Action</td>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7"></td>
                </tr>   
            </tbody>
        </table>
    </div>
  </div>
</section>
<script>

document.getElementById('add_student_form').addEventListener('submit', function(e) {
    
});
</script>
@endsection('content')

