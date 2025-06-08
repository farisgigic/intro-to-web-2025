const renderForumPosts = (postsArray) => {
    if (!Array.isArray(postsArray)) {
        console.error("Error: Expected an array but got", postsArray);
        return;
    }

    let forumContainer = document.querySelector(".blog .row");

    forumContainer.innerHTML = ""; // Clear previous posts

    postsArray.forEach((post) => {
        let postHTML = `
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__text">
                    <h5><a href="#">${post.title}</a></h5>
                        <ul style="list-style: none; padding-left: 0;">
                            <li><strong>Date:</strong> ${post.created_at}</li>
                        </ul>
                        <p>${post.description}</p>
                        <li><strong>Comments:</strong> 10 </li>
<button id="likeBtn" type="button" class="btn btn-outline-info">
  <i class="bi bi-hand-thumbs-up"></i> Like
</button>

                    </div>
                </div>
            </div>
        `;

        forumContainer.innerHTML += postHTML;
    });
};

document.addEventListener("DOMContentLoaded", () => {
    RestClient.get("forums/all",
        (data) => {
            renderForumPosts(data);
        },
        (error) => {
            console.error("Error fetching forum posts:", error);
        }
    );
});
