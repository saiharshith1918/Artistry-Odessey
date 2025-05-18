document.addEventListener('DOMContentLoaded', function() {
    // Load artists, posts, and reels
    loadArtists();
    loadPosts();
    loadReels();
});

function loadArtists() {
    const artists = [

        {
            name: "S. P. Balasubrahmanyam",
            style: "Playback Singing",
            famousWorks: ["Sankarabharanam", "Roja"],
           image: "artists/spb.jpg",
            website: "http://example.com/spbalasubrahmanyam",
            description: "S. P. Balasubrahmanyam was a celebrated Indian musician, playback singer, music director, actor, dubbing artist, and film producer who worked predominantly in Telugu, Tamil, Kannada, Hindi, and Malayalam films."
        },
        {
            name: "Lata Mangeshkar",
           style: "Playback Singing",
            famousWorks: ["Lag Ja Gale", "Ajeeb Dastan Hai Yeh"],
            image: "artists/lata.jpg",
            website: "http://example.com/latamangeshkar",
            description: "Lata Mangeshkar was known as the Nightingale of India, her voice having graced thousands of Bollywood films, creating an enduring legacy of Indian music."
        },
        {
            name: "Kishore Kumar",
            style: "Playback Singing",
            famousWorks: ["Mere Sapno Ki Rani", "Yeh Shaam Mastani"],
            image: "artists/kishore.jpg",
            website: "http://example.com/kishorekumar",
            description: "Kishore Kumar was a versatile Indian playback singer who won millions of hearts with his soulful voice and charismatic persona."
        },
       {
            name: "Arijit Singh",
            style: "Playback Singing",
            famousWorks: ["Tum Hi Ho", "Channa Mereya"],
           image: "artists/arijit.jpg",
          website: "http://example.com/arijitsingh",
          description: "Arijit Singh is known for his soul-stirring renditions in contemporary Bollywood music, touching hearts with his emotive singing style."
       },
       {
            name: "Shreya Ghoshal",
            style: "Playback Singing",
            famousWorks: ["Bairi Piya", "Dola Re Dola"],
            image: "artists/shreya.jpg",
            website: "http://example.com/shreyaghoshal",
            description: "Shreya Ghoshal has been a leading female playback singer in Indian cinema, known for her melodious voice and diverse song renditions."
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



function loadReels() {
    const reels = [
        { videoSrc: "reels/singing1.mp4", alt: "Art Reel 1 Description" },
        { videoSrc: "reels/singing2.mp4", alt: "Art Reel 2 Description" },
        { videoSrc: "reels/singing3.mp4", alt: "Art Reel 3 Description" },
        { videoSrc: "reels/singing4.mp4", alt: "Art Reel 4 Description" },
        { videoSrc: "reels/singing5.mp4", alt: "Art Reel 5 Description" },
        { videoSrc: "reels/singing6.mp4", alt: "Art Reel 6 Description" },
        { videoSrc: "reels/singing7.mp4", alt: "Art Reel 7 Description" },
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