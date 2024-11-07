<?php
// Get the category ID from the query parameter
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch podcasts from the API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://pandit.33crores.com/api/podcasts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);

$podcasts = json_decode($response, true);

// Filter podcasts by category ID
$filtered_podcasts = array_filter($podcasts['data'], function($podcast) use ($category_id) {
    return isset($podcast['podcast_category_id']) && $podcast['podcast_category_id'] == $category_id;
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/paymentfont.min.css">
	<link rel="stylesheet" href="css/slider-radio.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="img/store/logo33.jpg" sizes="64x64">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>Podcast</title>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <style>
.store-item__section {
    display: inline-block;
    vertical-align: top;
    padding: 10px;
}

.store-item__section--left, .store-item__section--right {
    width: 50%;
}

.store-item__section--middle {
    width: 60%;
}

.store-item__image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 100%;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.store-item__image-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.store-item__image-wrapper .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
}
::before {
    font-size: 19px;
}
/* Dropdown button */
.dropdown-button {
    /* background-color: #C1252F; */
    color: #000;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 100px;
    text-align: left;
    /* box-shadow: 3px 4px 6px rgb(0 0 0 / 20%); */
}

/* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
    width: 100%;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    margin-top: 0px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.category-section:hover{
  cursor: pointer;
  
}
/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 6px 5px;
    text-decoration: none;
    display: block;
    font-size: 15px;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown content when the button is clicked */
.show {
    display: block;
}
.category-image {
    border-radius: 50%;
    height: 150px;
    object-fit: cover;
    width: 150px !important;
    transition: box-shadow 0.3s ease-in-out;
}
.category-image:hover{
  box-shadow :rgb(201, 0, 2) 0px 0px, rgb(201, 0, 2) 0px 0px, rgb(220, 118, 117) 17px 23px 42px -5px, rgb(202, 2, 4) 0px 8px 10px -6px;
}
.category-name.text-center.d-block.mx-auto {
    letter-spacing: 1px;
    font-weight: 600;
    text-align: center !important;
    margin-top: 20px;
}


/* Style for the play icon */
.category-play-icon {
  position: absolute;
  bottom: 50px; /* Adjust based on your preference */
  right: 10px; /* Adjust based on your preference */
  font-size: 40px; /* Increase the size of the play icon */
  color: white; /* White color for the play icon */
  background-color: rgba(0, 0, 0, 0.5); /* Dark semi-transparent background */
  border-radius: 50%;
  padding: 5px 15px 10px 15px;
  transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

/* Hover effect to change play icon background */
.category-play-icon:hover {
  background-color: rgba(0, 0, 0, 0.7); /* Darker background on hover */
  cursor: pointer;
}

/* Style for the category name */
.category-name {
  letter-spacing: 1px;
  font-weight: 600;
  text-align: center !important;
  margin-top: 20px;
  font-size: 14px;
  color: #333; /* You can adjust the text color as needed */
}
.category-banner {
    position: relative;
    width: 100%;
    height: 350px; 
    background-size: center;
    background-position: center top;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 10px; /* Rounded corners for a unique look */
    margin-bottom:30px;
}

.category-banner .overlay {
    background: rgba(0, 0, 0, 0.5); /* Dark overlay for text readability */
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-title {
    color: #fff;
    font-size: 48px; /* Adjust size */
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7); /* Subtle shadow for depth */
    animation: fadeIn 2s ease-in-out; /* Text fade-in effect */
}

/* Add a subtle animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}


</style>

</head>

<body>
	<!-- header -->
	<header class="header">
  <div class="header__content container">
    <div class="">
      <a href="https://poojastore.33crores.com/">
        <img src="img/store/Logo_Black.webp" alt="" style="height: 49px;width: 105px;">
      </a>
    </div>
    <nav class="header__nav">
      <a href="https://poojastore.33crores.com/">Shop</a>
      <a href="https://pandit.33crores.com/">Book Pandit</a>
      <a href="https://poojastore.33crores.com/pages/about-us">About Us</a>
      <a href="https://poojastore.33crores.com/pages/contact">Contact Us</a>
    </nav>
    <button class="header__toggle" aria-label="Toggle navigation menu">
      ☰
    </button>
  </div>
</header>
	<!-- end header -->

	<!-- sidebar -->

	<!-- end sidebar -->
	<div class="player">
  <div class="player__cover">
    <img src="img/covers/cover.svg" alt="">
  </div>
  <div class="player__content">
    <span class="player__track">
      <b class="player__title">Select Podcast</b>
    </span>
    <audio
      src="https://dmitryvolkov.me/demo/blast2.0/audio/12071151_epic-cinematic-trailer_by_audiopizza_preview.mp3"
      id="audio" controls></audio>
  </div>
</div>


	<button class="player__btn" type="button">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M21.65,2.24a1,1,0,0,0-.8-.23l-13,2A1,1,0,0,0,7,5V15.35A3.45,3.45,0,0,0,5.5,15,3.5,3.5,0,1,0,9,18.5V10.86L20,9.17v4.18A3.45,3.45,0,0,0,18.5,13,3.5,3.5,0,1,0,22,16.5V3A1,1,0,0,0,21.65,2.24ZM5.5,20A1.5,1.5,0,1,1,7,18.5,1.5,1.5,0,0,1,5.5,20Zm13-2A1.5,1.5,0,1,1,20,16.5,1.5,1.5,0,0,1,18.5,18ZM20,7.14,9,8.83v-3L20,4.17Z"/>
  </svg>
  Player
</button>
	<!-- end player -->
<!-- main content for single category -->
<?php
// Get the category_id from the URL
$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

// Check if category_id is provided
if ($categoryId === null) {
    echo "Category ID is not specified.";
    exit;
}

// Fetch data from the API
$apiUrl = 'https://pandit.33crores.com/api/podcastcategory';
$categoryData = file_get_contents($apiUrl);

// Check if the API response is valid
if ($categoryData === false) {
    echo "Failed to fetch category data.";
    exit;
}

$categories = json_decode($categoryData, true); // Decode JSON to associative array

// Check if decoding was successful and 'data' field exists
if ($categories === null || !isset($categories['data'])) {
    echo "Invalid category data format.";
    exit;
}

// Find the category matching the category_id
$selectedCategory = null;
foreach ($categories['data'] as $category) {
    if ($category['id'] === $categoryId) {
        $selectedCategory = $category;
        break;
    }
}

// Check if category details were found
if ($selectedCategory === null) {
    echo "Category not found.";
    exit;
}

// Extract category details
$categoryImage = $selectedCategory['category_img'];
$categoryName = $selectedCategory['category_name'];
?>

<div class="category-banner" style="background-image: url('https://pandit.33crores.com/storage/<?php echo $categoryImage; ?>');">
    <div class="overlay">
        <h1 class="category-title"><?php echo htmlspecialchars($categoryName); ?></h1>
    </div>
</div>

<main class="main">
    <div class="container">
        <section class="row row--grid">
            <!-- <div class="col-12" style="margin-bottom: 30px;">
                <div class="main__title">
                    <h2>Podcasts in Category ID: <?php echo $category_id; ?></h2>
                </div>
            </div> -->

            <?php
            if (!empty($filtered_podcasts)) {
                foreach ($filtered_podcasts as $index => $podcast) {
                    $name = htmlspecialchars($podcast['name'] ?? 'Unknown Name');
                    $description = htmlspecialchars($podcast['description'] ?? 'No Description');
                    $image_url = htmlspecialchars($podcast['image_url'] ?? 'default-image.png');
                    $music_url = htmlspecialchars($podcast['music_url'] ?? '#');

                    echo '
                    <div class="col-md-6 col-xl-4">
                        <a data-link data-title="' . $name . '" data-artist="AudioPizza"
                           data-img="' . $image_url . '"
                           href="' . $music_url . '" class="single-item__cover" style="height: 245px !important">
                           <img src="' . $image_url . '" alt="' . $name . '">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M16,2a3,3,0,0,0-3,3V19a3,3,0,0,0,6,0V5A3,3,0,0,0,16,2Zm1,17a1,1,0,0,1-2,0V5a1,1,0,0,1,2,0ZM8,2A3,3,0,0,0,5,5V19a3,3,0,0,0,6,0V5A3,3,0,0,0,8,2ZM9,19a1,1,0,0,1-2,0V5A1,1,0,0,1,9,5Z"/>
                            </svg>
                        </a>
                        <li class="single-item">
                            <div class="single-item__title">
                                <h4 style="font-weight: bold;color: #C1252F;font-size: 18px">' . $name . '</h4>
                                <p style="font-size: 14px;">' . $description . '</p>
                            </div>
                             <div class="dropdown">
                                <button class="dropdown-button" onclick="toggleDropdown(' . $index . ')">  <i class="fa fa-share-alt"></i></button>
                                <div class="dropdown-content" id="dropdown-' . $index . '">
                                    <a href="#" class="whatsapp" id="whatsapp-share"><ion-icon name="logo-whatsapp"></ion-icon> WhatsApp</a>
                                    <a href="#" class="facebook"  id="facebook-share"><ion-icon name="logo-facebook"></ion-icon> Facebook</a>
                                    <a href="#" class="twitter" id="twitter-share"><i class="fa-brands fa-x-twitter"></i> Twitter</a>
                                </div>
                            </div>
                        </li>
                    </div>
                    ';
                }
            } else {
                echo '<p>No podcasts available for this category.</p>';
            }
            ?>
        </section>
    </div>
</main>
	<!-- end main content -->

	<!-- footer -->
	<section class="footer">
  <div class="container">
    <div class="card">
       <div class="footer1-div">
        <h5 class="text-16 fw-500 mb-30">Our Address</h5>
        <p style="color:#fff ;     line-height: 38px;">  33Crores Pooja Products Pvt Ltd ,<br> 403, 4th Floor, O-Hub<br>
          IDCO Sez Infocity,<br>
          Bhubaneswar 751024,<br>
          Odisha , Bharat<br>
          <br></p>
       </div>
    </div>
    <div class="card">
      <div class="footer2-div">
        <h5 class="text-16 fw-500 mb-30">Company</h5>
        <div class="d-flex y-gap-10 flex-column">
          <a href="https://poojastore.33crores.com/pages/about-us">About Us</a>
          <a href="https://poojastore.33crores.com/pages/our-story">Our Story</a>
          <a href="https://poojastore.33crores.com/pages/about-us">What is 33 Crores</a>
          <a href="https://poojastore.33crores.com/pages/contact">Contact</a>
          
        </div>
      </div>  
    </div>
    <div class="card">
      <div class="footer3-div">
        <h5 class="text-16 fw-500 mb-30">Shopping</h5>
        <div class="d-flex y-gap-10 flex-column">
          <a href="https://poojastore.33crores.com/pages/privacy-and-data-policy">Privacy & Data</a>
          <a href="https://poojastore.33crores.com/pages/terms-of-use">Terms & Conditions</a>
          <a href="https://poojastore.33crores.com/pages/product-cancellation-and-returns">Cancellation & Returns</a>
          <a href="https://poojastore.33crores.com/pages/business-tie-up-with-33crores">Business Enrollment</a>
          <a href="https://poojastore.33crores.com/pages/religious-service-provider">Religious Service Provider</a>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="footer4-div">
        <h5 class="text-16 fw-500 mb-30">Follow Us</h5>

             <div class="col-auto">
                <div class="d-flex x-gap-20 items-center">
                  <a href="https://www.facebook.com/33crores"><span style="font-size: 32px;margin-right: 20px" ><i class="fa-brands fa-square-facebook"></i></span></a>
                  <!-- <a href="https://www.youtube.com/33crores"><i class="fa fa-youtube-square text-18 " aria-hidden="true"></i></a> -->
                  <a href="https://www.instagram.com/33crores/"><span style="font-size: 32px;" ><i class="fa-brands fa-instagram"></i></span></a>
                  
                </div>
              </div>
      </div>
    </div>
  </div>
</section>

	<!-- end footer -->


	<!-- end modal info -->

	<!-- JS -->

    <script>

function toggleDropdown(index) {
    var dropdown = document.getElementById('dropdown-' + index);
    dropdown.classList.toggle("show");
}

 document.addEventListener("DOMContentLoaded", function () {
    // Get all share icons
    var whatsappShare = document.querySelectorAll("#whatsapp-share");
    var facebookShare = document.querySelectorAll("#facebook-share");
    var twitterShare = document.querySelectorAll("#twitter-share");

    // Function to add event listeners for sharing
    function addShareListeners(shares, platform) {
        shares.forEach(function (share) {
            share.addEventListener("click", function () {
                var pageUrl = window.location.href;
                var shareUrl;

                if (platform == "whatsapp") {
                    shareUrl = "https://wa.me/?text=" + encodeURIComponent(pageUrl);
                } else if (platform == "facebook") {
                    shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(pageUrl);
                } else if (platform == "twitter") {
                    shareUrl = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(pageUrl);
                }

                window.open(shareUrl, "_blank");
            });
        });
    }

    // Add listeners for each platform
    addShareListeners(whatsappShare, "whatsapp");
    addShareListeners(facebookShare, "facebook");
    addShareListeners(twitterShare, "twitter");
});

document.addEventListener("DOMContentLoaded", function () {
    // Get all share icons
    var whatsappShares = document.querySelectorAll("[id^='whatsapp-share-']");
    var facebookShares = document.querySelectorAll("[id^='facebook-share-']");
    var twitterShares = document.querySelectorAll("[id^='twitter-share-']");

    // Function to add event listeners for sharing
    function addShareListeners(shares, platform) {
        shares.forEach(function (share) {
            share.addEventListener("click", function () {
                var podcastUrl = share.closest("li").querySelector("a.single-item__cover").href;
                var currentPageUrl = window.location.href;
                var shareUrl;

                if (platform == "whatsapp") {
                    shareUrl = "https://wa.me/?text=" + encodeURIComponent(currentPageUrl);
                } else if (platform == "facebook") {
                    shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(currentPageUrl);
                } else if (platform == "twitter") {
                    shareUrl = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(currentPageUrl);
                }

                window.open(shareUrl, "_blank");
            });
        });
    }

    // Add listeners for each platform
    addShareListeners(whatsappShares, "whatsapp");
    addShareListeners(facebookShares, "facebook");
    addShareListeners(twitterShares, "twitter");
});


document.addEventListener('DOMContentLoaded', function() {
  const toggleButton = document.querySelector('.header__toggle');
  const nav = document.querySelector('.header__nav');

  toggleButton.addEventListener('click', function() {
    nav.classList.toggle('header__nav--open');
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const audioPlayer = document.getElementById('audio');
  const musicGif = document.getElementById('music-gif');
  const pauseImage = document.getElementById('pause-image');

  // Show GIF when audio is playing
  audioPlayer.addEventListener('play', function() {
    musicGif.style.display = 'block';
    pauseImage.style.display = 'none'; // Hide pause image when playing
  });

  // Show pause image and hide GIF when audio is paused
  audioPlayer.addEventListener('pause', function() {
    musicGif.style.display = 'none';
    pauseImage.style.display = 'block'; // Show pause image
  });

  // Hide both images when audio ends
  audioPlayer.addEventListener('ended', function() {
    musicGif.style.display = 'none';
    pauseImage.style.display = 'none';
  });
});

</script>
<!-- jQuery (necessary for Owl Carousel) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- <script src="js/myscript.js"></script> -->

	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/slider-radio.js"></script>
	<script src="js/jquery.inputmask.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/main.js"></script>
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>