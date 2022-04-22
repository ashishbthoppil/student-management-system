<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Student Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Student Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/" style="color:black;">Students List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('add.student') }}" style="color:black;">Add Students</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('add.marks') }}" style="color:black;">Add Marks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('view.marks') }}" style="color:black;">View student marks</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('add.teacher') }}">Add Teachers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('add.terms') }}">Terms</a>
        </li>
      </ul>
    </div>
  </div>
</nav>