
@include('layouts.header')
@include('layouts.menubar')
@include('layouts.droitemenu')




 <!-- partial -->
 <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>

      </div>
      <table class="table">
        <thead>
        <tr>
            <th scope="col">Photos</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Matricule</th>
          <th scope="col">Poste</th>
          <th scope="col">Date de naissance</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
      
        <tr>
            <td>
                <div class="nav-profile-image">
                    <img src="{{ asset('template/assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                  </div>
            </td>
          <td></td>
          <td></td>
          <td></td> 
          <td></td>  
          <td></td>  
    
              <form id="" method="POST" action="">
               
                @csrf
              </form>
            <td>
            <a class="btn btn-outline-success mb-2" href=""> <i class="bi-wrench"></i> Modifier</a>
          <form id="}" action="" method="post">
             @csrf
            <input type="hidden" name="_method" value="delete">
            </form>
          </td>
          <td>
        </tr>
        </tbody>
    </table>
     </div>
    </div>


     <script>
       axios.get('https://api.example.com/data')
  .then(response => {
    // Handle the response data
    console.log(response.data);
  })
  .catch(error => {
    // Handle any error that occurs
    console.error(error);
  });

     </script>
