document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        {
            name: "Ravi Shankar",
            style: "Sitar",
            famousWorks: ["Concerto for Sitar & Orchestra", "West Meets East"],
            image: "artists/ravishankar.jpeg",
            website: "http://example.com/ravishankar",
            description: "Ravi Shankar was a world-renowned sitar player known for his pioneering work in bringing Indian classical music to the global stage."
        },
        {
            name: "Zakir Hussain",
            style: "Tabla",
            famousWorks: ["Making Music", "Planet Drum"],
            image: "artists/zakirhussain.jpeg",
            website: "http://example.com/zakirhussain",
            description: "Zakir Hussain is a virtuoso tabla player, known for his exceptional contributions to both Indian classical music and world music collaborations."
        },            
            {
                name: "A.R. Rahman",
                style: "Film Score and Soundtracks",
                famousWorks: ["Jai Ho", "Bombay Theme"],
                image: "artists/arrahman.jpg",
                website: "http://example.com/arrahman",
                description: "A.R. Rahman is an Oscar-winning composer known for his innovative music style that blends Eastern classical music with electronic music sounds, world genres, and traditional orchestral arrangements."
            },
            {
                name: "Hariprasad Chaurasia",
                style: "Flute",
                famousWorks: ["Call of the Valley", "Raga Patdip"],
                image: "artists/hariprasadchaurasia.webp",
                website: "http://example.com/hariprasad",
                description: "Hariprasad Chaurasia is a celebrated Indian flautist, famous for his lyrical and expressive style of playing the bansuri in Hindustani classical music."
            },
            {
                name: "Sivamani",
                style: "Percussion",
                famousWorks: ["Drum Invocations", "Mahaleela"],
                image: "artists/sivamani.jpeg",
                website: "http://example.com/sivamani",
                description: "Sivamani is an iconic percussionist known for his vibrant and eclectic drumming styles, blending traditional Indian sounds with global music influences."
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