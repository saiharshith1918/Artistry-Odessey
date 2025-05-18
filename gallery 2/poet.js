document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [
        {
            name: "Rabindranath Tagore",
            era: "Late 19th - Early 20th Century",
            notableWorks: ["Gitanjali", "The Gardener"],
            image: "artists/tagore.jpeg",
            website: "http://example.com/tagore",
            description: "A Bengali polymath who reshaped Bengali literature and music, as well as Indian art with Contextual Modernism. Awarded the Nobel Prize in Literature in 1913."
        },
        {
            name: "Arunoday Singh",
            era: "21st Century",
            notableWorks: ["My Love Is Not Conditional", "Poems"],
            image: "artists/arunoday.jpeg",
            website: "http://example.com/arunoday",
            description: "A contemporary Indian actor and poet, Arunoday Singh is known for his heartfelt poetry and spoken word pieces that explore themes of love, loss, and healing. His works resonate with a modern audience, blending traditional poetic aesthetics with contemporary sensibilities."
        },
        {
            name: "Sarojini Naidu",
            era: "Early 20th Century",
            notableWorks: ["The Golden Threshold", "The Bird of Time"],
            image: "artists/sarojininaidu.jpeg",
            website: "http://example.com/naidu",
            description: "Known as the 'Nightingale of India', Naidu was a poet and politician. Her poetry includes both children's poems and others inspired by her intense patriotism."
        },
        {
            name: "A.K. Ramanujan",
            era: "20th Century",
            notableWorks: ["The Striders", "Relations"],
            image: "artists/ramanujan.jpeg",
            website: "http://example.com/ramanujan",
            description: "A scholar of Indian literature who wrote in both English and Kannada. Ramanujan's work, influenced by Indian folklore and tradition, bridges Indian and Western literary aesthetics."
        },
        {
            name: "Kamala Das",
            era: "20th Century",
            notableWorks: ["Summer in Calcutta", "The Descendants"],
            image: "artists/kamaladas.jpeg",
            website: "http://example.com/das",
            description: "Known for her open and honest treatment of female sexuality and marital issues in her writing. One of the prominent feminist voices in the postcolonial era."
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