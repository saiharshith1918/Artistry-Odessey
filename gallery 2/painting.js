document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
   // loadPosts();
    loadReels();
});
function loadArtists() {
    const artists = [
        {
            name: "Ram Kumar",
            style: "Abstract Expressionist",
            image: "artists/ramkumar.jpg",
            description: "Ram Kumar was one of the foremost abstract painters in India, known for his evocative landscapes and cityscapes that reflect a profound sense of spirituality and poetic lyricism.",
            famousWorks: ["Varanasi", "Vagabond"],
            website: "https://en.wikipedia.org/wiki/Ram_Kumar_(artist)"
        },
        {
            name: "S.H. Raza",
            style: "Bindu Art",
            image: "artists/shraza.jpg",
            description: "S.H. Raza is celebrated for his abstract Bindu art series.",
            famousWorks: ["Saurashtra", "Bindu"],
            website: "https://en.wikipedia.org/wiki/S._H._Raza"
        },
        {
            name: "Amrita Sher-Gil",
            style: "Avant-garde",
            image: "artists/amritashergil.jpg",
            description: "Amrita Sher-Gil was a prominent avant-garde painter and pioneer of modern Indian art.",
            famousWorks: ["Self Portrait", "Bride's Toilet"],
            website: "https://en.wikipedia.org/wiki/Amrita_Sher-Gil"
        },
        {
            name: "Tyeb Mehta",
            style: "Figurative",
            image: "artists/tyebmehta.jpg",
            description: "Tyeb Mehta is known for his impactful figurative paintings.",
            famousWorks: ["Diagonal Series", "Kali"],
            website: "https://en.wikipedia.org/wiki/Tyeb_Mehta"
        },
        {
            name: "Raja Ravi Varma",
            style: "Realistic",
            image: "artists/rajaravivarma.jpg",
            description: "Raja Ravi Varma was a celebrated painter of realistic and humanistic works.",
            famousWorks: ["Shakuntala", "Damayanti Talking to a Swan"],
            website: "https://en.wikipedia.org/wiki/Raja_Ravi_Varma"
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


/*function loadPosts() {
    const posts = [
        { image: "images/post-image-2.png", alt: "Art Post 1" },
        { image: "images/post-image-1.png", alt: "Art Post 2" }
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
}*/


function loadReels() {
    const reels = [
        { videoSrc: "painting/video1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "painting/video2.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "painting/video3.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "painting/video4.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "painting/video5.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "painting/video6.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "painting/video7.mp4", alt: "Art Reel 7 Description" },
        { videoSrc: "painting/video8.mp4", alt: "Art Reel 8 Description" },
        { videoSrc: "painting/video9.mp4", alt: "Art Reel 9 Description" },
        { videoSrc: "painting/video10.mp4", alt: "Art Reel 10 Description" }
        // Add more reels as needed
    ];
    const reelsContainer = document.querySelector('.reels-container');
    reelsContainer.innerHTML = ''; 

    reels.forEach(reel => {
        const videoElement = document.createElement('video');
        videoElement.src = reel.videoSrc;
        videoElement.setAttribute('title', reel.description); // Using title for accessibility
        videoElement.controls = true;

        videoElement.addEventListener('click', () => {
            if (document.fullscreenElement) {
                exitFullscreen();
            } else {
                enableFullscreen(videoElement);
            }
        });

        reelsContainer.appendChild(videoElement);
    });


    console.log('Reels loaded:', reels.length);
}

