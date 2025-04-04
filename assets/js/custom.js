// Add bubbles to the animation container
const container = document.querySelector('.animation-container');

// Add cups to the animation container
function createCup() {
  const cup = document.createElement('div');
  cup.classList.add('cup');
  cup.style.left = `${Math.random() * 100}%`;
  container.appendChild(cup);
}

for (let i = 0; i < 5; i++) {
  createCup();
}
