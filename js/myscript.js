document.addEventListener("DOMContentLoaded", function () {
  // Fetch Categories from API
  axios.get("https://pandit.33crores.com/api/podcastcategory")
    .then(response => {
      console.log("API Response:", response.data); // Log the response to inspect its structure
      const categories = response.data.data; // Access the 'data' field which contains the categories
      displayCategories(categories);
    })
    .catch(error => {
      console.error("Error fetching categories:", error);
      alert("Failed to load categories. Please try again later.");
    });
});

function displayCategories(categories) {
  const container = document.getElementById("categoryCarousel");
  container.innerHTML = ""; // Clear previous content

  if (categories.length === 0) {
    container.innerHTML = "<p>No categories available.</p>";
    return;
  }

  categories.forEach(category => {
    // Create a Bootstrap column div for each category
    const categoryItem = document.createElement("div");
    categoryItem.classList.add("item", "category-item"); // Owl Carousel item class

    // Create an anchor element for redirection
    const anchor = document.createElement("a");
    anchor.href = `single-category.php?category_id=${category.id}`; // Add href with category ID as a query parameter
    anchor.classList.add("category-link"); // Optional class for styling

    // Create category image container (for round shape and play icon)
    const imgContainer = document.createElement("div");
    imgContainer.classList.add("category-img-container"); // Container for round image and play icon

    // Create category image element
    const img = document.createElement("img");
    img.src = "https://pandit.33crores.com/storage/" + category.category_img; // Build the full image URL
    img.alt = category.category_name;
    img.classList.add("category-image", "img-fluid", "d-block", "mx-auto"); // Add Bootstrap class for responsive image and centering

    // Create the play icon
    const playIcon = document.createElement("i");
    playIcon.classList.add("fa", "fa-play-circle", "category-play-icon");

    // Category Name
    const name = document.createElement("div");
    name.classList.add("category-name", "text-center", "d-block", "mx-auto"); // Add text-center and margin-top
    name.textContent = category.category_name;

    // Append the image and play icon to the container
    imgContainer.appendChild(img);
    imgContainer.appendChild(playIcon);
    anchor.appendChild(imgContainer);
    anchor.appendChild(name);
    categoryItem.appendChild(anchor);
    container.appendChild(categoryItem);
  });

  // Initialize Owl Carousel after adding categories
  $('#categoryCarousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    }
  });
}

$(document).ready(function(){
  // Initialize Owl Carousel for Home Banner
  $('#homeBannerCarousel').owlCarousel({
    loop: true,           // Enable looping
    margin: 10,           // Add margin between slides
    nav: false,            // Enable next/prev buttons
    autoplay: true,       // Enable auto slide
    autoplayTimeout: 1000, // Auto slide timeout (5 seconds)
    autoplayHoverPause: true, // Pause on hover
    items: 1,             // Display one item per slide
    dots: false,           // Enable dots navigation
    animateOut: 'fadeOut', // Add fade out effect when transitioning between slides
    animateIn: 'fadeIn'   // Add fade in effect for incoming slides
  });
});
