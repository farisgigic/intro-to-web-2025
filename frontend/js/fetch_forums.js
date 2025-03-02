const renderForumPosts = (postsArray) => {
    if (!Array.isArray(postsArray)) {
        console.error("Error: Expected an array but got", postsArray);
        return; // Stop execution if data is not an array
    }

    let forumContainer = document.querySelector(".blog .row");

    forumContainer.innerHTML = ""; // Clear existing content

    postsArray.forEach((post) => {
        // let forum_id = post.forum_id;
        let imgSrc = post.img ? post.img : "default-image.jpg"; // Ensure fallback
        // console.log(`Rendering post: ${post.title}, Image: ${imgSrc}`); 

        let postHTML = `
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" style="background-image: url('${imgSrc}');">
                        <ul>
                            <li>By ${post.fullName}</li>
                            <li>${post.created_at}</li>
                            <li>${post.number_of_comments} Comments</li>
                            <li><button type="button" class="btn btn-outline-danger" onclick="ForumService.delete_forum();">Delete</button></li>
                        </ul>
                    </div>
                    <div class="blog__item__text">
                        <h5><a href="#">${post.title}</a></h5>
                        <p>${post.description}</p>
                    </div>
                </div>
            </div>
        `;

        forumContainer.innerHTML += postHTML;
    });
};

// Fetch Data and Call renderForumPosts()
document.addEventListener("DOMContentLoaded", () => {
    fetch("http://localhost/carcare/backend/forum")
        .then(response => response.json())
        .then(data => {
            // console.log("Fetched data:", data); // Debugging
            renderForumPosts(data); // Pass the fetched data to function
        })
        .catch(error => {
            console.error("Error fetching forum posts:", error);
        });
});
