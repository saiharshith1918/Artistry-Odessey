document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});


function loadArtists() {
    const artists = [
        {
            name: "Oggu Katha",
            region: "Telangana",
            description: "A traditional folk singing and storytelling art form, performed to the beats of drums and deals with themes from Hindu epics, especially Shiva.",
            image: "artists/oggukatha.jpeg",
            moreInfo: "http://example.com/oggukatha"
        },
        {
            name: "Burra Katha",
            region: "Andhra Pradesh",
            description: "A narrative entertainment that includes songs and stories, performed by a troupe of three. The stories are mostly based on folklore or cultural epics.",
            image: "artists/burrakatha.jpeg",
            moreInfo: "http://example.com/burrakatha"
        },
        {
            name: "Tholu Bommalata",
            region: "Andhra Pradesh",
            description: "Shadow puppetry tradition which uses leather puppets, casting colorful shadows on a backlit screen. It is known for its vivid portrayal of epics and folktales.",
            image: "artists/thollubomalu.jpeg",
            moreInfo: "http://example.com/tholubommalata"
        },
        {
            name: "Harikatha",
            region: "South India",
            description: "A form of Hindu religious discourse in which the storyteller uses music, dance, and drama to narrate stories from the scriptures.",
            image: "artists/harikatha.jpg",
            moreInfo: "http://example.com/harikatha"
        },
        {
            name: "Kathputli",
            region: "Rajasthan",
            description: "Traditional puppetry art form that is notable for its colorful, vivid storytelling with marionettes.",
            image: "artists/kathputli.jpg",
            moreInfo: "http://example.com/kathputli"
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
        { videoSrc: "reels/.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 7 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 8 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 9 Description" },
        { videoSrc: "reels/.mp4", alt: "Art Reel 10 Description" }
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