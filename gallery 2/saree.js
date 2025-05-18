document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        
            {
                name: "Pochampally",
                state: "Telangana",
                famousSarees: ["Pochampally Ikat"],
                image: "artists/pochampally.jpeg",
                website: "http://example.com/pochampally",
                description: "Pochampally sarees are known for their traditional geometric patterns in Ikat style of dyeing. The unique method of weaving makes these sarees highly distinctive and sought after."
            },
            {
                name: "Gadwal",
                state: "Telangana",
                famousSarees: ["Gadwal Silk Sarees"],
                image: "artists/gadwal.webp",
                website: "http://example.com/gadwal",
                description: "Gadwal sarees are famous for their rich zari borders and contrasting body. Made typically in silk, these sarees are cherished for their vibrant colors and intricate designs."
            },
            {
                name: "Venkatagiri",
                state: "Andhra Pradesh",
                famousSarees: ["Venkatagiri Silk Sarees"],
                image: "artists/venkatagiri.webp",
                website: "http://example.com/venkatagiri",
                description: "Venkatagiri sarees are known for their fine weaving quality and durability. These sarees are often light in weight and embellished with fine motifs spread across the body."
            },
            {
                name: "Uppada",
                state: "Andhra Pradesh",
                famousSarees: ["Uppada Silk Sarees"],
                image: "artists/uppada.jpeg",
                website: "http://example.com/uppada",
                description: "Uppada sarees, known for their lightweight and soft texture, are crafted using a traditional jamdani weaving method, which results in designs that are both intricate and luxurious."
            },
            {
                name: "Mangalagiri",
                state: "Andhra Pradesh",
                famousSarees: ["Mangalagiri Cotton Sarees"],
                image: "artists/mangalagiri.jpg",
                website: "http://example.com/mangalagiri",
                description: "Mangalagiri sarees are characterized by their crisp finish and distinctive zari work that typically adorns the borders, making them a popular choice for both casual and ceremonial wear."
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