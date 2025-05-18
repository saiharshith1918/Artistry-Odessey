document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        {
            name: "Kundan Jewelry",
            region: "Rajasthan",
            description: "Known for its intricate design and use of precious stones, Kundan jewelry is particularly associated with Rajasthan. It features elaborate work with gold and often incorporates uncut diamonds.",
            image: "artists/kundan.jpeg",
            website: "http://example.com/kundanjewelry"
        },
        {
            name: "Meenakari Jewelry",
            region: "Rajasthan",
            description: "This style involves enameling metal surfaces with vibrant colors, popular in various regions, including Rajasthan. Meenakari often complements Kundan to enhance the jewelry's beauty.",
            image: "artists/meenakari.jpg",
            website: "http://example.com/meenakarijewelry"
        },
        {
            name: "Polki Jewelry",
            region: "North India",
            description: "Featuring uncut diamonds set in gold, Polki jewelry is a traditional style that originated during the Mughal era. It is valued for its natural, unpolished diamonds.",
            image: "artists/polki.webp",
            website: "http://example.com/polki"
        },
        {
            name: "Lac Jewelry",
            region: "Rajasthan",
            description: "Originating from Rajasthan, Lac jewelry is made from a resin secreted by insects. Known for its bright colors and affordability, it's popular in festive and ethnic wear.",
            image: "artists/lac.webp",
            website: "http://example.com/lacjewelry"
        },
        {
            name: "Pachchikam Jewelry",
            region: "Gujarat",
            description: "A traditional form of Indian jewelry, Pachchikam has a delicate and intricate appearance, hailing from Gujarat. It's similar to Kundan but with a more rustic finish.",
            image: "artists/pachchikam.jpg",
            website: "http://example.com/pachchikamjewelry"
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
        { videoSrc: "reels/jewellery1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "reels/jewellery2.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "reels/jewellery3.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "reels/jewellery4.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "reels/jewellery5.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "reels/jewellery6.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "reels/jewellery7.mp4", alt: "Art Reel 7 Description" },
        { videoSrc: "reels/jewellery8.mp4", alt: "Art Reel 8 Description" },
        { videoSrc: "reels/jewellery9.mp4", alt: "Art Reel 9 Description" },
        { videoSrc: "reels/jewellery10.mp4", alt: "Art Reel 10 Description" }
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