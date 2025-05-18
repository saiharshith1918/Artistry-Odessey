document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadPotteryMakingRegions();
    loadPosts();
    loadReels();
});
function loadPotteryMakingRegions() {
    const regions = [
        {
            name: "Rajasthan",
            style: "Blue Pottery",
            famousProducts: ["Decorative Tiles", "Ornamental Pots"],
            image: "artists/rajasthan.jpg",
            website: "http://example.com/rajasthan",
            description: "Rajasthan is celebrated for its Blue Pottery, known for its unique blue dyeing techniques applied to decorative tiles, pots, and other ceramic items."
        },
        {
            name: "Uttar Pradesh",
            style: "Terracotta Pottery",
            famousProducts: ["Terracotta Vases", "Garden Pottery"],
            image: "artists/up.jpg",
            website: "http://example.com/uttarpradesh",
            description: "Uttar Pradesh's terracotta pottery is famous for its rustic finish and earthy appeal, often seen in vases and various garden pottery products."
        },
        {
            name: "West Bengal",
            style: "Bankura Pottery",
            famousProducts: ["Bankura Horse", "Decorative Pots"],
            image: "artists/bengal.png",
            website: "http://example.com/westbengal",
            description: "West Bengal's Bankura district is known for its distinctive terracotta pottery, especially the iconic Bankura horse, symbolizing artistic excellence."
        },
        {
            name: "Madhya Pradesh",
            style: "Black Pottery",
            famousProducts: ["Black Clay Pots", "Decorative Articles"],
            image: "artists/mp.jpg",
            website: "http://example.com/madhyapradesh",
            description: "Madhya Pradesh is renowned for its Black Pottery, utilizing unique local clay that gives the pottery its characteristic black color and smooth finish."
        },
        {
            name: "Tamil Nadu",
            style: "Tanjore Pottery",
            famousProducts: ["Tanjore Dolls", "Functional Ware"],
            image: "artists/tn.jpg",
            website: "http://example.com/tamilnadu",
            description: "Tamil Nadu's Tanjore region is known for its vibrant pottery, making colorful dolls and functional ware, integral to local traditions and festivities."
        }
    ];

    const grid = document.querySelector('.artist-grid');
    regions.forEach(region => {
        const regionDiv = document.createElement('div');
        regionDiv.className = 'artist-profile';

        regionDiv.innerHTML = `
            <img src="${region.image}" alt="Pottery in ${region.name}">
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