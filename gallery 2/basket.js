document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadBasketWeavingRegions();
    loadPosts();
    loadReels();
});
function loadBasketWeavingRegions() {
    const regions = [
        {
            name: "Assam",
            style: "Cane and Bamboo Weaving",
            famousProducts: ["Japi", "Bamboo Furniture"],
            image: "artists/assam.jpg",
            website: "http://example.com/assam",
            description: "Assam is renowned for its rich tradition of cane and bamboo crafts, including functional and decorative baskets that are integral to local daily life."
        },
        {
            name: "Tripura",
            style: "Bamboo and Cane Weaving",
            famousProducts: ["Tripuri Baskets", "Handcrafted Mats"],
            image: "artists/tripura.jpg",
            website: "http://example.com/tripura",
            description: "Tripura boasts a skilled workforce in bamboo and cane weaving, producing intricate products known for their durability and traditional designs."
        },
        {
            name: "Kashmir",
            style: "Willow Weaving",
            famousProducts: ["Kangri Baskets", "Willow Cricket Bats"],
            image: "artists/kashmir.jpg",
            website: "http://example.com/kashmir",
            description: "Kashmir’s willow weaving craft produces utilitarian items such as baskets and cricket bats, deeply intertwined with local customs and needs."
        },
        {
            name: "West Bengal",
            style: "Cane Weaving",
            famousProducts: ["Cane Baskets", "Cane Furniture"],
            image: "artists/bengal.png",
            website: "http://example.com/westbengal",
            description: "West Bengal is famous for its exquisite cane weaving, used to make elaborately designed furniture and baskets, showcasing remarkable craftsmanship."
        },
        {
            name: "Odisha",
            style: "Sabai Grass Weaving",
            famousProducts: ["Sabai Ropes", "Sabai Baskets"],
            image: "artists/odisha.jpg",
            website: "http://example.com/odisha",
            description: "Odisha's Sabai grass weaving is a sustainable craft, turning grass into ropes, mats, and baskets, significant for the state’s rural economy."
        }
    ];

    const grid = document.querySelector('.artist-grid');
    regions.forEach(region => {
        const regionDiv = document.createElement('div');
        regionDiv.className = 'artist-profile';

        regionDiv.innerHTML = `
            <img src="${region.image}" alt="Weaving in ${region.name}">
            <h3>${region.name}</h3>
            <p>${region.style}</p>
            <p>${region.description}</p>
            <a href="${region.website}" target="_blank">Visit Website</a>
        `;

        grid.appendChild(regionDiv);
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
        { videoSrc: "reels/basket1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "reels/basket2.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "reels/basket3.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "reels/basket4.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "reels/basket5.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "reels/basket6.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "reels/basket7.mp4", alt: "Art Reel 7 Description" },
        { videoSrc: "reels/basket8.mp4", alt: "Art Reel 8 Description" },
        { videoSrc: "reels/basket9.mp4", alt: "Art Reel 9 Description" },
        { videoSrc: "reels/basket10.mp4", alt: "Art Reel 10 Description" }
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
