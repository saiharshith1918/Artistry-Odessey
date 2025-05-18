document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        {
            name: "Rukmini Devi Arundale",
            style: "Bharatanatyam",
            image: "artists/rukminidevi.jpg",
            famousWorks: ["Kalakshetra", "Sita Swayamvar"],
            website: "http://example.com/rukminidevi",
            description: "A visionary dancer and choreographer who revitalized Bharatanatyam and founded the Kalakshetra Foundation."
        },
        {
            name: "Pandit Birju Maharaj",
            style: "Kathak",
            image: "artists/panditbirju.jpg",
            famousWorks: ["Krishna Leela", "Draupadi Cheer Haran"],
            website: "http://example.com/birjumaharaj",
            description: "A legendary Kathak dancer known for his profound storytelling and rhythmic skills."
        },
        {
            name: "Uday Shankar",
            style: "Fusion",
            image: "artists/udayshankar.jpg",
            famousWorks: ["Labor and Machinery", "Tandava"],
            website: "http://example.com/udayshankar",
            description: "An innovative dancer who created a new style of Indian dance, amalgamating classical and tribal forms."
        },
        {
            name: "Padma Subrahmanyam",
            style: "Bharatanatyam",
            image: "artists/padmasubrahmanyam.jpg",
            famousWorks: ["Syama Sastri’s Swarajati", "Navarasa"],
            website: "http://example.com/padmasubrahmanyam",
            description: "A renowned Bharatanatyam dancer noted for her pioneering work in dance research and choreography."
        },
        {
            name: "Sonal Mansingh",
            style: "Odissi",
            image: "artists/sonalmansingh.jpg",
            famousWorks: ["Geeta Govinda", "Indradhanush"],
            website: "http://example.com/sonalmansingh",
            description: "A celebrated exponent of Odissi and Bharatanatyam, noted for her artistic storytelling."
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