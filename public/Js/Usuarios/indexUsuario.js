const cards = document.querySelectorAll('.card');
let currentIndex = 0;
const totalCards = cards.length;

function updateVisibility() {
  cards.forEach((card, index) => {
    card.className = 'card';
    
    if (index === currentIndex || 
        index === (currentIndex + 1) % totalCards || 
        index === (currentIndex + 2) % totalCards) {
      card.classList.add('visible');
      
      if (index === currentIndex) {
        card.classList.add('left');
      } else if (index === (currentIndex + 1) % totalCards) {
        card.classList.add('center');
      } else {
        card.classList.add('right');
      }
    }
  });
}

function moveLeft() {
  currentIndex = (currentIndex - 1 + totalCards) % totalCards;
  updateVisibility();
}

function moveRight() {
  currentIndex = (currentIndex + 1) % totalCards;
  updateVisibility();
}

// Initial setup
updateVisibility();