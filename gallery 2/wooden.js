document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadWoodenStyles();
    loadPosts();
    loadReels();
});

function loadWoodenStyles(){
    const artists = [
        {
            name: "Channapatna Toys",
            origin: "Karnataka",
            description: "Originating from Karnataka, these toys are known for their vibrant colors and lacquer finish, making them safe and attractive for children.",
            image: "artists/channapatna.jpg",
            moreInfo: "http://example.com/channapatna"
        },
        {
            name: "Kondapalli Toys",
            origin: "Andhra Pradesh",
            description: "Hailing from Andhra Pradesh, Kondapalli toys are made from softwood and are famous for their intricate detailing and themes from Indian mythology.",
            image: "artists/kondapali.jpg",
            moreInfo: "http://example.com/kondapalli"
        },
        {
            name: "Etikoppaka Toys",
            origin: "Andhra Pradesh",
            description: "Also from Andhra Pradesh, Etikoppaka toys are made using the traditional lac-turnery craft and are known for their bright and natural vegetable dye colors.",
            image: "artists/etikoppaka.jpg",
            moreInfo: "http://example.com/etikoppaka"
        },
        {
            name: "Thanjavur Dolls",
            origin: "Tamil Nadu",
            description: "These are traditional South Indian bobble-head or roly-poly toys made of terracotta or wood, adorned with bright clothes and precious stones.",
            image: "artists/thanjavur.jpg",
            moreInfo: "http://example.com/thanjavur"
        },
        {
            name: "Nirmal Toys",
            origin: "Telangana",
            description: "From Telangana, Nirmal toys are known for their ethnic look and vegetable dyes, often depicting rural life, animals, and historical figures.",
            image: "artists/nirmal.jpg",
            moreInfo: "http://example.com/nirmal"
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

        const moreInfo = document.createElement('a');
        moreInfo.href = artist.website;
        moreInfo.textContent = 'Visit Website';
        moreInfo.target = '_blank';

        artistDiv.appendChild(image);
        artistDiv.appendChild(name);
        artistDiv.appendChild(description);
        artistDiv.appendChild(moreInfo);

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
        { videoSrc: "reels/wooden1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "reels/wooden2.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "reels/wooden3.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "reels/wooden4.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "reels/wooden5.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "reels/wooden6.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "reels/wooden7.mp4", alt: "Art Reel 7 Description" },
        { videoSrc: "reels/wooden8.mp4", alt: "Art Reel 8 Description" },
        { videoSrc: "reels/wooden9.mp4", alt: "Art Reel 9 Description" },
        { videoSrc: "reels/wooden10.mp4", alt: "Art Reel 10 Description" }
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