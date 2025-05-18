document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        {
            name: "Arun Yogiraj",
            style: "Stone Sculpture",
            famousWorks: ["Statue of Adi Shankaracharya", "Bust of Swami Vivekananda"],
            image: "artists/arun.jpg",
            website: "http://example.com/arunyogiraj",
            description: "Arun Yogiraj is celebrated for his exquisite stone sculptures that capture the essence of his subjects with remarkable realism and detail."
        },
        {
            name: "Bharti Kher",
            style: "Mixed Media",
            famousWorks: ["The Skin Speaks a Language Not Its Own", "An Absence of Assignable Cause"],
            image: "artists/bharti.jpeg",
            website: "http://example.com/bhartikher",
            description: "Bharti Kher uses mixed media, including bindis, to explore themes of identity, culture, and society. Her works often incorporate elements of mythology and narrative to challenge preconceived notions of form."
        },
        {
            name: "Subodh Gupta",
            style: "Installation Art and Sculpture",
            famousWorks: ["Line of Control", "Very Hungry God"],
            image: "artists/subodh.jpeg",
            website: "http://example.com/subodhgupta",
            description: "Subodh Gupta is known for working with everyday objects, transforming stainless steel tiffin boxes, thalis, and bicycles into sculptures and installations that reflect on migration, globalization, and the economic transformation of India."
        },
        {
            name: "Dhruva Mistry",
            style: "Bronze Sculpting",
            famousWorks: ["River", "The Horse"],
            image: "artists/dhruva.jpg",
            website: "http://example.com/dhruvamistry",
            description: "Dhruva Mistry has been a significant figure in Indian sculpture for decades, creating works in bronze that range from the figurative to the abstract. His sculptures often deal with human and animal forms, exploring the relationship between nature and mythology."
        },
        {
            name: "Arunkumar HG",
            style: "Environmental Art",
            famousWorks: ["Feed", "Globally Local"],
            image: "artists/arunkumar.jpeg",
            website: "http://example.com/arunkumarhg",
            description: "Arunkumar HG creates sculptures and installations primarily from recycled and reclaimed materials. His works address the issues of consumerism, sustainability, and ecology, highlighting the impact of industrialization on nature."
        }        

    ];

    const grid = document.querySelector('.artist-grid');
    
    artists.forEach(artist => {
        const artistDiv = document.createElement('div');
        artistDiv.className = 'artist-profile';

        const image = document.createElement('img');
        image.src = artist.image;
        image.alt = `Portrait of ${artist.name}`;

        const name = document.createElement('h3');
        name.textContent = artist.name;

        const description = document.createElement('p');
        description.textContent = artist.description;

        const website = document.createElement('a');
        website.href = artist.website;
        website.textContent = 'Visit Website';
        website.target = '_blank';

        artistDiv.appendChild(image);
        artistDiv.appendChild(name);
        artistDiv.appendChild(description);
        artistDiv.appendChild(website);

        grid.appendChild(artistDiv);
    });
}



function loadPosts() {
    const posts = [
        { image: "path/to/your/image1.jpg", alt: "Art Post 1" },
        { image: "path/to/your/image2.jpg", alt: "Art Post 2" }
        // Add more posts as needed
    ];

    const postsContainer = document.getElementById('posts');
    
    posts.forEach(post => {
        const postDiv = document.createElement('div');
        postDiv.className = 'post';

        const img = document.createElement('img');
        img.src = post.image;
        img.alt = post.alt;

        postDiv.appendChild(img);
        postsContainer.appendChild(postDiv);
    });
}
function loadReels() {
    const reels = [
        { videoSrc: "path/to/your/video1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "path/to/your/video2.mp4", alt: "Art Reel 2 Description" }
        // Add more reels as needed
    ];

    const reelsContainer = document.querySelector('.reels-container');

    reels.forEach(reel => {
        const videoElement = document.createElement('video');
        videoElement.src = reel.videoSrc;
        videoElement.alt = reel.alt; // Alt isn't usually used with video, but you might use it for accessibility as part of aria-label or title
        videoElement.controls = true;  // Allows the user to control video playback

        reelsContainer.appendChild(videoElement);
    });
}