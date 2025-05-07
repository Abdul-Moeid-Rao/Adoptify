<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Adoptify</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/adopt_style.css">
  
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- Header Section Start -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <img src="images/logo3.png" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html"> About</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="pets.php"> Adopt Pets </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blogs.html"> Blogs </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Contact Us</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
          <div>
            <div class="custom_menu-btn ">
              <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- Header Section End -->
  </div>

  <div class="container">
  <div class="heading_container">
      <h2>Our Adoptable Pets <span>Looking for a Home</span></h2>
    </div>
    <p>Meet our adorable pets waiting for a loving home. Each one has a unique personality and is ready to bring joy to your life.</p>

  <div class="category-container">
      <div class="heading_container">
        <h2>Select a Pet Category</h2>
      </div>
      <select id="categorySelect" class="category-select" onchange="filterPets()">
        <option value="all">All Pets</option>
        <option value="dogs">Dogs</option>
        <option value="cats">Cats</option>
        <option value="fish">Fish</option>
        <option value="birds">Birds</option>
        <option value="rabbits">Rabbits</option>
        <!-- <option value="hamsters">Hamsters</option>
        <option value="turtles">Turtles</option>
        <option value="lizards">Lizards</option>
        <option value="ferrets">Ferrets</option>
        <option value="chinchillas">Chinchillas</option>
        <option value="mice">Mice</option>
        <option value="gerbils">Gerbils</option>
        <option value="sugar-gliders">Sugar Gliders</option> -->
      </select> 
    </div>
    
    <div class="row" id="petGallery">
      <?php
      // Connect to the database
      $conn = new mysqli('localhost', 'root', '', 'adoptify_db');

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Fetch pets from the database
      $sql = "SELECT * FROM pets";
      $result = $conn->query($sql);

      // Display pets dynamically
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 gallery_item" data-category="' . $row['category'] . '">';
              echo '<img src="images/list/' . $row['image'] . '" alt="' . $row['name'] . '" class="img-fluid">';
              echo '<div class="gallery_overlay">';
              echo '<h4>' . $row['name'] . '</h4>';
              echo '<button class="btn-adopt" onclick="openAdoptForm(\'' . $row['name'] . '\')">Adopt Now</button>';
              echo '<p>' . $row['description'] . '</p>';
              echo '</div></div>';
          }
      } else {
          echo "<p>No pets available for adoption.</p>";
      }

      $conn->close();
      ?>
    </div>
  </div>

  <!-- Adoption Modal -->
  <div class="adopt-form-popup" id="adoptFormPopup" >
    <div class="adopt-form-container">
      <h4>Adopt a Pet: <span id="petNameLabel"></span></h4>
      <form id="adoptForm" action="adopt.php" method="POST">
        <input type="text" id="petName" name="petName" readonly placeholder="Pet Name" />
        <input type="text" id="adopterName" name="adopterName" placeholder="Your Name" required />
        <input type="email" id="adopterEmail" name="adopterEmail" placeholder="Your Email" required />
        <input type="text" id="adopterPhone" name="adopterPhone" placeholder="Your Phone" required />
        <textarea id="adopterMessage" name="adopterMessage" placeholder="Why do you want to adopt?" required></textarea>
        <button type="submit">Submit Adoption Request</button>
        <button type="button" onclick="closeAdoptForm()">Close</button>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <section class="container-fluid footer_section layout_padding2-top">
    <div class="social-box">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-linkedin-in"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    <p>
        &copy; <span id="displayYear"></span> All Rights Reserved by Adoptify | Developed by <a href="https://abdul-moeid-rao.github.io/Portfolio-/portfolio.html">AB Developer</a>
      </p>
  </section>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
  <script>
    function openAdoptForm(petName) {
      document.getElementById("petName").value = petName;
      document.getElementById("petNameLabel").innerText = petName;
      document.getElementById("adoptFormPopup").style.display = "block";
    }

    function closeAdoptForm() {
      document.getElementById("adoptFormPopup").style.display = "none";
    }
  </script>
</body>

</html>
