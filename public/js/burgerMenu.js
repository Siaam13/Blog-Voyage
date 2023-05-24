document.addEventListener('DOMContentLoaded', (event) => {
  const navbarBurger = document.querySelector('.navbar-burger');
  const navbarLinks = document.querySelector('.navbar-links');
  const burgerLines = document.querySelectorAll('.burger-line');

  navbarBurger.addEventListener('click', () => {
    navbarBurger.classList.toggle('burger-active');
    navbarLinks.classList.toggle('active');

    burgerLines.forEach(line => {
      line.classList.toggle('burger-active');
    });
  });
});
